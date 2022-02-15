import React from 'react';
import PropTypes from 'prop-types';
import { makeStyles, withStyles } from '@mui/styles';
import clsx from 'clsx';
import Stepper from '@mui/material/Stepper';
import Step from '@mui/material/Step';
import StepLabel from '@mui/material/StepLabel';
import Check from '@mui/icons-material/Check';
import VideoLabelIcon from '@mui/icons-material/VideoLabel';
import StepConnector from '@mui/material/StepConnector';
import  HourglassEmptyIcon  from '@mui/icons-material/HourglassEmpty';
import  LocalShippingIcon  from '@mui/icons-material/LocalShipping';
import { Button, Grid, LinearProgress  } from '@mui/material';
import swal from 'sweetalert';

import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';

const useQontoStepIconStyles = makeStyles({
  root: {
    color: '#eaeaf0',
    display: 'flex',
    height: 22,
    alignItems: 'center',
  },
  active: {
    color: '#784af4',
  },
  circle: {
    width: 8,
    height: 8,
    borderRadius: '50%',
    backgroundColor: 'currentColor',
  },
  completed: {
    color: '#784af4',
    zIndex: 1,
    fontSize: 18,
  },
});

function QontoStepIcon(props) {
  const classes = useQontoStepIconStyles();
  const { active, completed } = props;

  return (
    <div
      className={clsx(classes.root, {
        [classes.active]: active,
      })}
    >
      {completed ? <Check className={classes.completed} /> : <div className={classes.circle} />}
    </div>
  );
}

QontoStepIcon.propTypes = {
  /**
   * Whether this step is active.
   */
  active: PropTypes.bool,
  /**
   * Mark the step as completed. Is passed to child components.
   */
  completed: PropTypes.bool,
};

const ColorlibConnector = withStyles({
  alternativeLabel: {
    top: 22,
  },
  active: {
    '& $line': {
      backgroundImage:
        'linear-gradient( 95deg,rgb(242,113,33) 0%,rgb(233,64,87) 50%,rgb(138,35,135) 100%)',
    },
  },
  completed: {
    '& $line': {
      backgroundImage:
        'linear-gradient( 95deg,rgb(242,113,33) 0%,rgb(233,64,87) 50%,rgb(138,35,135) 100%)',
    },
  },
  line: {
    height: 3,
    border: 0,
    backgroundColor: '#eaeaf0',
    borderRadius: 1,
  },
})(StepConnector);

const useColorlibStepIconStyles = makeStyles({
  root: {
    backgroundColor: '#ccc',
    zIndex: 1,
    color: '#fff',
    width: 50,
    height: 50,
    display: 'flex',
    borderRadius: '50%',
    justifyContent: 'center',
    alignItems: 'center',
  },
  active: {
    backgroundImage:
      'linear-gradient( 136deg, rgb(242,113,33) 0%, rgb(233,64,87) 50%, rgb(138,35,135) 100%)',
    boxShadow: '0 4px 10px 0 rgba(0,0,0,.25)',
  },
  completed: {
    backgroundImage:
      'linear-gradient( 136deg, rgb(242,113,33) 0%, rgb(233,64,87) 50%, rgb(138,35,135) 100%)',
  },
});

function ColorlibStepIcon(props) {
  const classes = useColorlibStepIconStyles();
  const { active, completed } = props;

  const icons = {
    1: <HourglassEmptyIcon style={{color:'#FFF'}} />,
    2: <LocalShippingIcon style={{color:'#FFF'}} />,
    3: <VideoLabelIcon />,
  };

  return (
    <div
      className={clsx(classes.root, {
        [classes.active]: active,
        [classes.completed]: completed,
      })}
    >
      {icons[String(props.icon)]}
    </div>
  );
}

ColorlibStepIcon.propTypes = {
  /**
   * Whether this step is active.
   */
  active: PropTypes.bool,
  /**
   * Mark the step as completed. Is passed to child components.
   */
  completed: PropTypes.bool,
  /**
   * The label displayed in the step icon.
   */
  icon: PropTypes.node,
};


const useStyles = makeStyles((theme) => ({
  root: {
    width: '100%',
    justifyContent: 'center',
  },
  button: {
    marginRight: theme.spacing(1),
  },
  instructions: {
    marginTop: theme.spacing(1),
    marginBottom: theme.spacing(1),
  },
  txtConfirmed:{
    marginTop:20,
    fontSize:25,
    color:'#549a46',
  }
}));

function getSteps(numEnvio) {
    let txtEnviado = 'Enviado';
    if (numEnvio != null) {
        txtEnviado = 'Enviado - Cod.: '+numEnvio;
    }
  return ['Pendiente', txtEnviado, 'Recibido'];
}


export default function CustomizedSteppers(props) {
  const classes = useStyles();
  const [activeStep, setActiveStep] = React.useState(0);
  const [confirm , setConfirm] = React.useState(props.info.confirmed);
  const steps = getSteps(props.numEnvio);

  const confirmData = () => {
    
      
      fetch('/Kit/confirm/'+props.info.id)
      .then(response => response.json())
      .then(data => {
        if (data.estado) {
          setConfirm(true);
        }else{
          swal('Error', 'Error al confirmar datos, contactese con soporte', 'error');
        }
      })
  }


  React.useEffect(() =>{
    if (props.info.estado == 'pendiente') {
      setActiveStep(0);
    }else{
      setActiveStep(1);
    }
  },[]);

  return (
    <Grid container direction="column" className={classes.root}>
      <h5 style={{color:'#000'}}>{props.title}</h5>
      <Grid item>

        <Stepper alternativeLabel activeStep={activeStep} connector={<ColorlibConnector />}>
          {steps.map((label) => (
            <Step key={label}>
              <StepLabel StepIconComponent={ColorlibStepIcon}>{label}</StepLabel>
            </Step>
          ))}
        </Stepper>
      </Grid>
      
      <Grid item>
        <Grid container direction="row" justify="center">

            <AlertDialog info={props.info}/>
        </Grid>
      </Grid>

    </Grid>
  );
}

function AlertDialog(props) {
  const [open, setOpen] = React.useState(false);
  const [confirm , setConfirm] = React.useState(props.info.confirmed);
  const classes = useStyles();

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const confirmData = () => {
    
      
    fetch('/Kit/confirm/'+props.info.id)
    .then(response => response.json())
    .then(data => {
      if (data.estado) {
        setConfirm(true);
      }else{
        swal('Error', 'Error al confirmar datos, contactese con soporte', 'error');
      }
    })
    setOpen(false);
  }

  const renderDataEnvio = () =>{
    if (props.info.user.datos_user != null) {
      return (
        <ul>
          <li>Direccion : {props.info.user.datos_user.direccion}</li>
          <li>Provincia : {props.info.user.datos_user.provincia}</li>
          <li>Localidad : {props.info.user.datos_user.ciudad}</li>
          <li>Codigo Postal : {props.info.user.datos_user.CP}</li>
        </ul>
      );
    }
    return(
      <div className="alert alert-danger">
        <p>
          No hay datos de envio cargados, puede cargarlos en la seccion <b>Datos Personales </b>
          o bien comunicarse con su profesor por whatsapp para que se los cargue correctamente.
        </p>
        
      </div>
    );
  }


  if (confirm) {
    return (
      <Grid item className='w-full'>

            <h3 className={classes.txtConfirmed+ " justify-center flex"}>Datos Confirmados <img className="ml-3" src="/img/checked.png" alt=""/></h3>
      </Grid>
    );
  }

  return (
    <div style={{marginTop:20}}>
      <div className="alert alert-info text-center">
        <p>

        Revisa y confirma los <b> datos de envio </b> para poder recibir tu kit de herramientas.
        </p>
        <p><b>NO CONFIRME SI LOS DATOS NO ESTAN CORRECTOS</b></p>
      </div>
      <LinearProgress  />
      <Grid style={{marginTop:20}} container direction="row" justify="center">
        <Button variant="contained" color="primary" onClick={handleClickOpen} >
            Confirmar datos
        </Button>
      </Grid>
      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
      >
        <DialogTitle id="alert-dialog-title">{"Datos de envio"}</DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description">
            <div className="alert alert-danger text-center">
              <p>

              Controla que los datos de envio esten correctos, de lo contrario el paquete rebotara.
              En dicho caso el costo del nuevo envio <b> sera a coste del alumno.</b>
              </p>
            <p><b>NO CONFIRME SI LOS DATOS NO ESTAN CORRECTOS</b></p>
            </div>
            {renderDataEnvio()}
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose} color="secondary" variant="contained">
            Cancelar
          </Button>
          <Button onClick={confirmData} color="primary" variant="contained" autoFocus>
            Confirmar
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  );
}