import React from 'react';
import PropTypes from 'prop-types';
import { makeStyles } from '@mui/styles';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import TableSortLabel from '@mui/material/TableSortLabel';
import Paper from '@mui/material/Paper';
import FormControlLabel from '@mui/material/FormControlLabel';
import Switch from '@mui/material/Switch';
import { Button } from '@mui/material';
import BuildIcon from '@mui/icons-material/Build';
import RowTableCobros from './RowTableCobros';


function createData(id, name, fecha_sig_cobro, monto, tarjeta, cargarCobro, date, fondos, conFondos) {

  return { id, name, fecha_sig_cobro, monto, tarjeta, cargarCobro, date, fondos, conFondos };
}



function descendingComparator(a, b, orderBy) {
  if (b[orderBy] < a[orderBy]) {
    return -1;
  }
  if (b[orderBy] > a[orderBy]) {
    return 1;
  }
  return 0;
}

function getComparator(order, orderBy) {
  return order === 'desc'
    ? (a, b) => descendingComparator(a, b, orderBy)
    : (a, b) => -descendingComparator(a, b, orderBy);
}

function stableSort(array, comparator) {
  const stabilizedThis = array.map((el, index) => [el, index]);
  stabilizedThis.sort((a, b) => {
    const order = comparator(a[0], b[0]);
    if (order !== 0) return order;
    return a[1] - b[1];
  });
  return stabilizedThis.map((el) => el[0]);
}

const headCells = [
  { id: 'id', numeric: true, disablePadding: true, label: '#' },
  { id: 'name', numeric: false, disablePadding: false, label: 'Nombre' },
  { id: 'fecha_sig_cobro', numeric: false, disablePadding: false, label: 'Fecha sig cobro' },
  { id: 'monto', numeric: true, disablePadding: false, label: 'Monto cuota' },
  { id: 'tarjeta', numeric: false, disablePadding: false, label: 'Tarjeta' },
  { id: 'cargarCobro', numeric: false, disablePadding: false, label: 'Action' },
  { id: 'fondos', numeric: false, disablePadding: false, label: '---' },
];

function EnhancedTableHead(props) {
  const { classes, order, orderBy, onRequestSort } = props;
  const createSortHandler = (property) => (event) => {
    onRequestSort(event, property);
  };

  return (
    <TableHead>
      <TableRow>
        {headCells.map((headCell) => (
          <TableCell
            key={headCell.id}
            align={headCell.numeric ? 'left' : 'right'}
            padding={headCell.disablePadding ? 'none' : 'default'}
            sortDirection={orderBy === headCell.id ? order : false}
          >
            <TableSortLabel
              active={orderBy === headCell.id}
              direction={orderBy === headCell.id ? order : 'asc'}
              onClick={createSortHandler(headCell.id)}
            >
              {headCell.label}
              {orderBy === headCell.id ? (
                <span className={classes.visuallyHidden}>
                  {order === 'desc' ? 'sorted descending' : 'sorted ascending'}
                </span>
              ) : null}
            </TableSortLabel>
          </TableCell>
        ))}
      </TableRow>
    </TableHead>
  );
}

EnhancedTableHead.propTypes = {
  classes: PropTypes.object.isRequired,
  numSelected: PropTypes.number.isRequired,
  onRequestSort: PropTypes.func.isRequired,
  order: PropTypes.oneOf(['asc', 'desc']).isRequired,
  orderBy: PropTypes.string.isRequired,
  rowCount: PropTypes.number.isRequired,
};

const useStyles = makeStyles((theme) => ({
  root: {
    width: '100%',
  },
  paper: {
    width: '100%',
    marginBottom: theme.spacing(2),
  },
  table: {
    minWidth: 750,
  },
  visuallyHidden: {
    border: 0,
    clip: 'rect(0 0 0 0)',
    height: 1,
    margin: -1,
    overflow: 'hidden',
    padding: 0,
    position: 'absolute',
    top: 20,
    width: 1,
  },
  filaSinFondo: {
    background: '#FE2E2E'
  }
}));

export default function TablaCobros2(props) {
  const classes = useStyles();
  const [order, setOrder] = React.useState('asc');
  const [orderBy, setOrderBy] = React.useState('calories');
  const [selected, setSelected] = React.useState([]);
  const [page, setPage] = React.useState(0);
  const [dense, setDense] = React.useState(true);
  const [rowsPerPage, setRowsPerPage] = React.useState(15);
  const [rows, setRows] = React.useState([]);
  const [cobros, setCobros] = React.useState([]);

  function getCobros() {

    if (cobros.length == 0) {
      setRows([]);
    }
    else {

      setRows(cobros.map((cobro, index) => {

        if (cobro.datos_user == null) {
          cobro.datos_user = { 'tarjeta': 'sin cargar' }
        }
        let date = new Date(cobro.updated_at);
        date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();

        const cargarCobro = <Button
          variant="contained"
          color="primary"
          onClick={() => props.setUser(cobro.user_id, index, cobro)}
        >Cargar cobro</Button>;
        const fondos = <Button
          variant="contained"
          color="secondary"
          onClick={() => props.modificarFondos(cobro.user_id, props.selectedMonth)}
        >Fondos <br /> <small> {date} </small></Button>

        let monto = cobro.monto_cuota;
        if (cobro.user.kit) {
          let infoKit = null;
          if (cobro.user.datos_kit != null) {
            if (cobro.user.datos_kit.kit_type != null) {

              infoKit = cobro.user.datos_kit.kit_type.name + " ($" + cobro.user.datos_kit.kit_type.precio + " )";
            } else {
              infoKit = "sin informacion de tipo de kit";
            }

          }
          monto = <div>  {cobro.monto_cuota}  <BuildIcon color="primary" /> {infoKit}</div>;
        }
        let data = createData(
          cobro.user_id,
          cobro.user.name,
          cobro.fecha_sig_cobro,
          monto,
          cobro.datos_user.tarjeta,
          cargarCobro,
          date,
          fondos,
          cobro.fondos
        );
        return data;

      }));
    }
  }

  React.useEffect(() => {

    setCobros(props.cobros);
  },
    [props.cobros]);

  React.useEffect(() => {

    getCobros();
  }, [cobros]);


  const handleRequestSort = (event, property) => {
    const isAsc = orderBy === property && order === 'asc';
    setOrder(isAsc ? 'desc' : 'asc');
    setOrderBy(property);
  };

  const handleChangeDense = (event) => {
    setDense(event.target.checked);
  };

  const emptyRows = rowsPerPage - Math.min(rowsPerPage, rows.length - page * rowsPerPage);

  const handleChangeFondos = (index) => {

    let aux = cobros;
    aux[index].conFondos = !cobros[index].conFondos;

    setCobros(aux);
    getCobros();
  }


  return (
    <div className={classes.root}>
      <Paper className={classes.paper}>
        <TableContainer>
          <Table
            className={classes.table}
            aria-labelledby="tableTitle"
            size={dense ? 'small' : 'medium'}
            aria-label="enhanced table"
          >
            <EnhancedTableHead
              classes={classes}
              numSelected={selected.length}
              order={order}
              orderBy={orderBy}
              onRequestSort={handleRequestSort}
              rowCount={rows.length}
            />
            <TableBody>
              {stableSort(rows, getComparator(order, orderBy))
                .map((row, index) => {
                  const labelId = `enhanced-table-checkbox-${index}`;
                  return (
                    <RowTableCobros key={index} row={row} index={index} changeFondos={() => handleChangeFondos(index)} />
                  );

                })}
              {emptyRows > 0 && (
                <TableRow style={{ height: (dense ? 33 : 53) * emptyRows }}>
                  <TableCell colSpan={6} />
                </TableRow>
              )}
            </TableBody>
          </Table>
        </TableContainer>

      </Paper>
      <FormControlLabel
        control={<Switch checked={dense} onChange={handleChangeDense} />}
        label="Estilo filas"
      />
    </div>
  );
}
