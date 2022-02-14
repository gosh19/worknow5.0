import React from 'react';
import { makeStyles } from '@mui/material/styles';
import ListSubheader from '@mui/material/ListSubheader';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import Collapse from '@mui/material/Collapse';
import ExpandLess from '@mui/icons-material/ExpandLess';
import ExpandMore from '@mui/icons-material/ExpandMore';
import AttachMoneyIcon from '@mui/icons-material/AttachMoney';
import MoneyOffIcon from '@mui/icons-material/MoneyOff';
import MonetizationOnIcon from '@mui/icons-material/MonetizationOn';
import CreditCardIcon from '@mui/icons-material/CreditCard';
import LocalAtmIcon from '@mui/icons-material/LocalAtm';
import BuildIcon from '@mui/icons-material/Build';
import TrendingUpIcon from '@mui/icons-material/TrendingUp';

import SentimentDissatisfiedIcon from '@mui/icons-material/SentimentDissatisfied';
import SentimentSatisfiedAltIcon from '@mui/icons-material/SentimentSatisfiedAlt';
import SentimentVerySatisfiedIcon from '@mui/icons-material/SentimentVerySatisfied';
import { Snackbar } from '@mui/material';
import MuiAlert from '@material-ui/lab/Alert';

function Alert(props) {
  return <MuiAlert elevation={6} variant="filled" {...props} />;
}

const useStyles = makeStyles(theme => ({
  root: {
    width: '100%',
    maxWidth: 360,
    backgroundColor: theme.palette.background.paper,
  },
  nested: {
    paddingLeft: theme.spacing(4),
  },
}));


export default function NestedList(props) {
  const classes = useStyles();

  const [openVentas, setOpenVentas] = React.useState(false);
  const [openInfoComision, setOpenInfoComision] = React.useState(false);
  const [objetivo, setObjetivo] = React.useState(props.objetivo.cantidad_cursos);
  const [iconPuntos, setIconPuntos] = React.useState(null);
  const [textObjetivo, setTextObjetivo] = React.useState(null);
  const [colorObjetivo, setColorObjetivo] = React.useState(null);
  const [sueldo, setSueldo] = React.useState(0);
 
  
  const cantEfectivo = props.ventasAlta.filter(venta =>( venta.datos_alumno.tipo_pago == 'efectivo'));
  const cantEfectivoTotal = props.ventasAlta.filter(venta =>( venta.datos_alumno.tipo_pago == 'efectivoTotal'));
  const cantCredito = props.ventasAlta.filter(venta => ((venta.datos_alumno.tipo_pago == 'credito') || (venta.datos_alumno.tipo_pago == null)));
  const cantKit = props.ventasAlta.filter(venta => ( venta.datos_alumno.kit == 1));


  const totalPuntos = props.puntos;
  React.useEffect(() => {
    switch (true) {
      case totalPuntos<objetivo:
        
        setIconPuntos(<SentimentDissatisfiedIcon style={{color: '#DF0101'}} />);
        setTextObjetivo("Faltan "+((props.objetivo.cantidad_cursos) - totalPuntos)+" para llegar al objetivo");
        setColorObjetivo("warning");
        break;
      case totalPuntos==objetivo:
        setIconPuntos(<SentimentSatisfiedAltIcon style={{color: '#045FB4'}} />);
        setTextObjetivo("Objetivo alcanzado con exito!");
        setColorObjetivo("info");
        break;
      case totalPuntos>objetivo:
        setSueldo((totalPuntos - objetivo)*300);
        setIconPuntos(<SentimentVerySatisfiedIcon style={{color: '#04B404'}} />);
        setTextObjetivo("Objetivo superado");
        setColorObjetivo("success");
        break;
      default:
        break;
    }
            
  }, []);
          
          
  const handleClickVenta = () => {
    if (!openVentas) {     
      setOpenInfoComision(!openInfoComision);
    }
    setOpenVentas(!openVentas);
  };


  const handleCloseInfoComision = (event, reason) => {
    if (reason === 'clickaway') {
      return;
    }

    setOpenInfoComision(!openInfoComision);
  };
  return (
    <List
      component="nav"
      aria-labelledby="nested-list-subheader"
      subheader={
        <ListSubheader component="div" id="nested-list-subheader">
          Estadisticas mensuales
        </ListSubheader>
      }
      className={classes.root}
    >
      <ListItem>
        <ListItemIcon>
          <TrendingUpIcon style={{color: '#ff6600'}} fontSize='large' />
        </ListItemIcon>
        <ListItemText primary={"Rendimiento: "+props.rendimiento} />
      </ListItem>
      <ListItem>
        <ListItemIcon>
          <LocalAtmIcon style={{color: '#0B610B'}} fontSize='large' />
        </ListItemIcon>
        <ListItemText primary={"Comisiones: $"+sueldo} />
      </ListItem>

      <ListItem button onClick={handleClickVenta}>
        <ListItemIcon>
          <AttachMoneyIcon style={{color: '#04B404'}} fontSize='large' />
        </ListItemIcon>
        <ListItemText primary={"Ventas del mes: "+props.ventasAlta.length} />
        {openVentas ? <ExpandLess /> : <ExpandMore />}
      </ListItem>

      <Collapse in={openVentas} timeout="auto" unmountOnExit>
        <List component="div" disablePadding>

        <ListItem button className={classes.nested}>
          <ListItemIcon>
            <CreditCardIcon color='primary' />
          </ListItemIcon>
          <ListItemText primary={cantCredito.length+" Creditos"} />
        </ListItem>
        <ListItem button className={classes.nested}>
          <ListItemIcon>
            <LocalAtmIcon color='secondary' />
          </ListItemIcon>
          <ListItemText primary={cantEfectivo.length+" Efectivos"} />
        </ListItem>
        <ListItem button className={classes.nested}>
          <ListItemIcon>
            <MonetizationOnIcon color='primary' />
          </ListItemIcon>
          <ListItemText primary={cantEfectivoTotal.length+" Efectivos Totales"} />
        </ListItem>
        <ListItem button className={classes.nested}>
          <ListItemIcon>
            <BuildIcon color='secondary' />
          </ListItemIcon>
          <ListItemText primary={cantKit.length+" Kits"} />
        </ListItem>
        <hr />
        <ListItem button className={classes.nested}>
          <ListItemIcon>
            {iconPuntos}
          </ListItemIcon>
          <ListItemText primary={totalPuntos+" Puntos Comision"} />
          <Snackbar style={{marginTop:50}} anchorOrigin={{ vertical: 'top', horizontal: 'center' }} open={openInfoComision} autoHideDuration={3000} onClose={handleCloseInfoComision}>
            <Alert onClose={handleCloseInfoComision} severity={colorObjetivo}>
              {textObjetivo}
            </Alert>
          </Snackbar>
        </ListItem>
        </List>
      </Collapse>
      <ListItem button>
        <ListItemIcon>
          <MoneyOffIcon color='secondary' fontSize='large' />
        </ListItemIcon>
        <ListItemText primary={"Bajas del mes: "+props.ventasBaja.length} />
      </ListItem>
      
    </List>
  );
}