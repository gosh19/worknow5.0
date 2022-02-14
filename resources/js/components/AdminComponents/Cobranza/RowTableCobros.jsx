import React from 'react';
import { TableRow, TableCell, makeStyles, Button } from '@mui/material';
import clsx from 'clsx';

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


export default function RowTableCobros(props) {
    const classes = useStyles();
    const [fondos, setFondos] = React.useState();
    const [date, setDate] = React.useState(props.row.date);
    const [txt, setTxt] = React.useState(0);
    
    function modificarFondos(id) {
        let d = new Date();
        if (!fondos) {
          setTxt(1);
        }else{
          setTxt(0);
        }
        fetch('/modificar-fondos/'+id);
        setFondos(!fondos);
        setDate(d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear());
        props.changeFondos(props.index);
    }

    React.useEffect(() =>{
      setFondos(props.row.conFondos);
      
      if (props.row.conFondos) {
        setTxt(1);
      }else{
        setTxt(0);
      }
    },[props.row.conFondos]);
    
    return(
    <TableRow
        tabIndex={-1}
        key={props.row.id}
        className={clsx({[classes.filaSinFondo]: !fondos})}
      >
        <TableCell component="th" scope="props.row" padding="none">
          {props.row.id}
        </TableCell>
        <TableCell align="right"><a href={"/modificarAlumno?id="+props.row.id}>{props.row.name}</a></TableCell>
        <TableCell align="right">{props.row.fecha_sig_cobro}</TableCell>
        <TableCell align="left">{props.row.monto}</TableCell>
        <TableCell align="right">{props.row.tarjeta}</TableCell>
        <TableCell align="right">{props.row.cargarCobro}</TableCell>
        <TableCell align="right">
                        <Button 
                            variant="contained" 
                            color="secondary"
                            onClick={() => modificarFondos(props.row.id)}
                        >Fondos {txt} <br/> <small> {date} </small></Button> 
        </TableCell>
      </TableRow>
      )
}