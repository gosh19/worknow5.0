import React from 'react';
import PropTypes from 'prop-types';
import clsx from 'clsx';
import { lighten, makeStyles } from '@mui/styles';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import TableSortLabel from '@mui/material/TableSortLabel';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Paper from '@mui/material/Paper';
import IconButton from '@mui/material/IconButton';
import Tooltip from '@mui/material/Tooltip';
import FormControlLabel from '@mui/material/FormControlLabel';
import Switch from '@mui/material/Switch';
import DeleteIcon from '@mui/icons-material/Delete';
import FilterListIcon from '@mui/icons-material/FilterList';
import Backdrop from '@mui/material/Backdrop';
import Fade from '@mui/material/Fade';

import Factura from './Factura';
import { Button, Modal, Input } from '@mui/material';


function createData(id,userId, name, email, monto, tipoPago, dni, numOperacion, factura, date, acumulado) {
  return { id, userId, name, email, monto, tipoPago, dni, numOperacion, factura, date, acumulado };
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
  return stabilizedThis.map(el => el[0]);
}

const headCells = [
  { id: 'userId', numeric: false, disablePadding: true, label: 'N° Alumno' },
  { id: 'name', numeric: true, disablePadding: false, label: 'Nombre' },
  { id: 'email', numeric: true, disablePadding: false, label: 'email' },
  { id: 'monto', numeric: false, disablePadding: false, label: 'Monto' },
  { id: 'tipopago', numeric: false, disablePadding: false, label: 'Tipo Pago' },
  { id: 'dni', numeric: true, disablePadding: false, label: 'DNI' },
  { id: 'numOperacion', numeric: true, disablePadding: false, label: 'N° operacion' },
  { id: 'numFactura', numeric: true, disablePadding: false, label: 'N° factura' },
  { id: 'date', numeric: true, disablePadding: false, label: 'Fecha' },
  { id: 'acumulado', numeric: true, disablePadding: false, label: 'Acumulado' },
];

function EnhancedTableHead(props) {
  const { classes, order, orderBy, onRequestSort } = props;
  const createSortHandler = property => event => {
    onRequestSort(event, property);
  };

  return (
    <TableHead>
      <TableRow>
        {headCells.map(headCell => (
          <TableCell
            key={headCell.id}
            align={headCell.numeric ? 'right' : 'left'}
            padding={'none'}
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
  onSelectAllClick: PropTypes.func.isRequired,
  order: PropTypes.oneOf(['asc', 'desc']).isRequired,
  orderBy: PropTypes.string.isRequired,
  rowCount: PropTypes.number.isRequired,
};

const useToolbarStyles = makeStyles(theme => ({
  root: {
    paddingLeft: theme.spacing(2),
    paddingRight: theme.spacing(1),
  },
  highlight:
    theme.palette.type === 'light'
      ? {
          color: theme.palette.secondary.main,
          backgroundColor: theme.palette.secondary.light,
        }
      : {
          color: theme.palette.text.primary,
          backgroundColor: theme.palette.secondary.dark,
        },
  title: {
    flex: '1 1 100%',
  },
}));

const EnhancedTableToolbar = props => {
  const classes = useToolbarStyles();
  const { numSelected } = props;

  return (
    <Toolbar
      className={clsx(classes.root, {
        [classes.highlight]: numSelected > 0,
      })}
    >
      {numSelected > 0 ? (
        <Typography className={classes.title} color="inherit" variant="subtitle1">
          {numSelected} selected
        </Typography>
      ) : (
        <Typography className={classes.title} variant="h6" id="tableTitle">
          Cobros realizados
        </Typography>
      )}

      {numSelected > 0 ? (
        <Tooltip title="Delete">
          <IconButton aria-label="delete">
            <DeleteIcon />
          </IconButton>
        </Tooltip>
      ) : (
        <Tooltip title="Filter list">
          <IconButton aria-label="filter list">
            <FilterListIcon />
          </IconButton>
        </Tooltip>
      )}
    </Toolbar>
  );
};

EnhancedTableToolbar.propTypes = {
  numSelected: PropTypes.number.isRequired,
};

const useStyles = makeStyles(theme => ({
  root: {
    width: '100%',
  },
  paper: {
    width: '100%',
    marginBottom: theme.spacing(2),
  },
  table: {
    width: '100%',
  },
  visuallyHidden: {
    border: 0,
    clip: 'rect(0 0 0 0)',
    height: 1,
    margin: -1,
    overflow: 'visible',
    padding: 0,
    position: 'absolute',
    top: 20,
    width: 1,
  },
  modal: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  divModal:{
    backgroundColor: '#FFF',
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
  }
}));

export default function EnhancedTable(props) {
  const classes = useStyles();
  const [order, setOrder] = React.useState('asc');
  const [orderBy, setOrderBy] = React.useState('protein');
  const [selected, setSelected] = React.useState([]);
  const [dense, setDense] = React.useState(true);
  const [rows, rowsChange] = React.useState([]);
  const [modal, setModal] = React.useState(false);

  const [idEdit, setidEdit] = React.useState();
  const [montoEdit, setmontoEdit] = React.useState();
  const [numEdit, setnumEdit] = React.useState();
  const [dateEdit, setdateEdit] = React.useState();

 

  React.useEffect(() => {

    let filas = new Array();
    let acumulado = 0;
    
    props.cobros.map((cobro) => {
        let date = new Date(cobro.fecha);
        date = (date.getDate()+1)+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        acumulado = acumulado + cobro.monto;

        let dni = <div  style={{color:"#FF0000"}}><p>Sin datos para mostar</p></div>;
        if (cobro.user.datos_user != null) {
          dni = <div>
                    <ul>
                      <li>{cobro.user.datos_user.dni}</li>
                      <li>{cobro.user.datos_user.provincia}</li>
                    </ul>
                </div>;
          if ((cobro.user.tipo_pago == "credito")) {
            cobro.user.tipo_pago = cobro.user.datos_user.tarjeta;
          }
        }

        filas.push(
            createData(
                cobro.id, 
                cobro.user.id, 
                cobro.user.name, 
                cobro.user.email,
                cobro.monto, 
                cobro.user.tipo_pago, 
                dni,
                cobro.numero_operacion, 
                cobro.factura,
                date,
                ((acumulado)*props.descuento),
              )
            );
    })
    rowsChange(filas);

  }, [props.cobros])


  const handleRequestSort = (event, property) => {
    const isAsc = orderBy === property && order === 'asc';
    setOrder(isAsc ? 'desc' : 'asc');
    setOrderBy(property);
  };

  const handleSelectAllClick = event => {
    if (event.target.checked) {
      const newSelecteds = rows.map(n => n.name);
      setSelected(newSelecteds);
      return;
    }
    setSelected([]);
  };

  const handleChangeDense = event => {
    setDense(event.target.checked);
  };

  const emptyRows = 0;
  
  function openModalEdit(index) {
    setModal(true);
    setidEdit(rows[index].id),
    setmontoEdit(rows[index].monto);
    setnumEdit(rows[index].numOperacion);
    setdateEdit(rows[index].date);
  }

  const handleClose = () => {
    setModal(false);
  };

  const editCobro = () => {
    const data = {
      'id': idEdit,
      'monto': montoEdit,
      'numOperacion': numEdit,
      'date': dateEdit
    }
    fetch('/edit-cobro',{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      credentials: "same-origin",
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(info => {
      if (info.estado) {
        swal('Great!', 'Modificado con exito', 'success');  
        setModal(false);    
      }else{
        swal('Error!', 'Error al modificar', 'error');
      } 
    });

    
  }

  const handleInputChange = (e) => {
    const value =e.target.value;
    switch (e.target.name) {
      case 'monto':
        setmontoEdit(value);
        break;
      case 'numOperacion':
        setnumEdit(value)
        break;
      case 'date':
        setdateEdit(value);
        break;
      default:
        break;
    }
    
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
                /*.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage)*/
                .map((row, index) => {
                  const labelId = `enhanced-table-checkbox-${index}`;
                 
                  return (
                    <TableRow
                      hover
                      tabIndex={-1}
                      key={row.id}
                    >

                      <TableCell component="th" id={labelId} scope="row" padding="none">
                        {row.userId}<Button variant="contained" color="secondary" onClick={() => openModalEdit(index)} >Editar</Button>
                      </TableCell>
                      <TableCell align="right" padding="none"><a href={"/modificarAlumno?id="+row.userId}>{row.name}</a></TableCell>
                      <TableCell padding="none" align="right">{row.email}</TableCell>
                      <TableCell padding="none" align="right">{row.monto}</TableCell>
                      <TableCell padding="none" align="right">{row.tipoPago}</TableCell>
                      <TableCell padding="none" align="right">{row.dni}</TableCell>
                      <TableCell padding="none" align="right">{row.numOperacion}</TableCell>
                      <TableCell padding="none" align="right"><Factura user={row} /> </TableCell>
                      <TableCell padding="none" align="right">{row.date}</TableCell>
                      <TableCell style={{fontSize:20, fontFamily: 'Arial', fontWeight:'bold'}} align="right">$ {row.acumulado} </TableCell>
                    </TableRow>
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
        label="Dense padding"
      />
      <Modal
        open={modal}
        aria-labelledby="transition-modal-title"
        aria-describedby="transition-modal-description"
        className={classes.modal}
        onClose={handleClose}
        closeAfterTransition
        BackdropComponent={Backdrop}
        BackdropProps={{
          timeout: 500,
        }}
      >
        <Fade in={modal}>
          <div className={classes.divModal}>
            <Input autofocus value={montoEdit} type="number" name="monto" onChange={handleInputChange} />
            <Input value={numEdit} name="numOperacion" onChange={handleInputChange} />
            <Input value={dateEdit} name="date" onChange={handleInputChange} />
            <Button variant="contained" color="primary" onClick={editCobro} >Editar</Button>
          </div>
        </Fade>
      </Modal>
    </div>
  );
}
