import React from 'react';
import { makeStyles } from '@mui/material/styles';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import { CircularProgress, Button } from '@mui/material';
import clsx from 'clsx';

const useStyles = makeStyles({
  table: {
    minWidth: 650,
  },
  filaSinFondo:{
    background: "#FF0000"
  }
});

export default function SimpleTable(props) {
  const classes = useStyles();

  const [rows , setRows] = React.useState(<CircularProgress />);

  function getCobros(){

    if (props.cobros.length == 0) {
      setRows(<tr><td><CircularProgress /></td></tr>);
    }
    else{
      setRows(props.cobros.map((cobro, index) => {

        if (cobro.datos_user == null) {
          cobro.datos_user = {'tarjeta': 'sin cargar'}
        }
        let date = new Date(cobro.updated_at);
        date = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();

        return(
          <TableRow 
            key={cobro.user_id} 
            className={clsx({[classes.filaSinFondo]: !cobro.fondos})}
          >
          <TableCell component="th" scope="row">
            {cobro.user_id}
          </TableCell>
          <TableCell align="right"><a href={"/modificarAlumno?id="+cobro.user_id}> {cobro.user.name}</a></TableCell>
          <TableCell align="right">{cobro.fecha_sig_cobro}</TableCell>
          <TableCell align="right">{cobro.monto_cuota}</TableCell>
          <TableCell align="right">{cobro.datos_user.tarjeta}</TableCell>
          <TableCell align="center">
            <Button 
              variant="contained" 
              color="primary"
              onClick={() => props.setUser(cobro.user_id, index, cobro)}
            >Cargar cobro</Button> 
          </TableCell>
          <TableCell align="center">
            <Button 
              variant="contained" 
              color="secondary"
              onClick={() => props.modificarFondos(cobro.user_id, props.selectedMonth)}
            >Fondos <br/> <small> {date} </small></Button> 
          </TableCell>
        </TableRow>
          )
        }));
    }
  }

  React.useEffect(() => { 
    getCobros();
  },
  [props.cobros]);

  return (
    <TableContainer component={Paper}>
      <Table className={classes.table} aria-label="simple table">
        <TableHead>
          <TableRow>
            <TableCell>Num. Alumno</TableCell>
            <TableCell align="right">Nombre</TableCell>
            <TableCell align="right">Fecha de cobro</TableCell>
            <TableCell align="right">Valor Cuota</TableCell>
            <TableCell align="right">Tarjeta</TableCell>
            <TableCell align="center">Action</TableCell>
            <TableCell align="center">---</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {rows}
        </TableBody>
      </Table>
    </TableContainer>
  );
}