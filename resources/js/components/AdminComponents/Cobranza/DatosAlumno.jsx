import React from 'react';
import { makeStyles } from '@mui/material/styles';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import Grid from '@mui/material/Grid';
import Typography from '@mui/material/Typography';
import PhoneIcon from '@mui/icons-material/Phone';
import EmailIcon from '@mui/icons-material/Email';
import AssignmentIndIcon from '@mui/icons-material/AssignmentInd';
import BathtubIcon from '@mui/icons-material/Bathtub';
import QueuePlayNextIcon from '@mui/icons-material/QueuePlayNext';
import CreditCardIcon from '@mui/icons-material/CreditCard';

const useStyles = makeStyles((theme) => ({
    root: {
    },
    demo: {
        backgroundColor: theme.palette.background.paper,
    },
    title: {
        margin: theme.spacing(0, 0, 0),
    },
    text:{
        marginLeft:15,
    }
    })
);



export default function DatosAlumno(props) {
  const classes = useStyles();
  const [dense, setDense] = React.useState(false);
  

  if (props.user.datos_user == null) {
    props.user.datos_user = {dni: "sin cargar", telefono: "sin cargar", tarjeta:"sin cargar"}
  }


  return (
    <div className={classes.root}>


        <Grid>
          <Typography variant="h6" className={classes.title}>
            Datos Alumno
          </Typography>
          <div className={classes.demo}>
            <List >
                <ListItem>
                    <ListItemIcon>
                        <BathtubIcon />
                        N° :
                    </ListItemIcon>
                    <ListItemText
                        className={classes.text}
                        primary={ props.user.id}
                    />
                </ListItem>
                <ListItem>
                    <ListItemIcon>
                        <AssignmentIndIcon />
                        DNI :
                    </ListItemIcon>
                    <ListItemText
                        className={classes.text}
                        primary={ props.user.datos_user.dni}
                    />
                </ListItem>
                <ListItem>
                    <ListItemIcon>
                        <PhoneIcon />
                        Telefono :
                    </ListItemIcon>
                    <ListItemText
                        className={classes.text}
                        primary={ props.user.datos_user.telefono}
                    />
                </ListItem>
                <ListItem>
                    <ListItemIcon>
                        <EmailIcon />
                        Email :
                    </ListItemIcon>
                    <ListItemText
                        className={classes.text}
                        primary={props.user.email }
                    />
                </ListItem>
                <ListItem>
                    <ListItemIcon>
                        <CreditCardIcon />
                        Tarjeta :
                    </ListItemIcon>
                    <ListItemText
                        className={classes.text}
                        primary={props.user.datos_user.tarjeta }
                    />
                </ListItem>
                <hr/>
                {props.user.adicionales.map((ad,index) =>{

                    return(
                        <ListItem>
                            <ListItemIcon>
                                <QueuePlayNextIcon style={{color:'#FF0000',marginRight:20,}}/>
                               <h5> {ad.denominacion} :</h5>
                            </ListItemIcon>
                            <ListItemText
                                className={classes.text}
                                primary={"$ "+ad.valor+" - "+ ad.cant_cuotas }
                            />
                        </ListItem>
                    );
                })}
                
            </List>
          </div>
        </Grid>
      
    </div>
  );
}
