import React from 'react';
import { makeStyles } from '@mui/material/styles';
import Card from '@mui/material/Card';
import CardActionArea from '@mui/material/CardActionArea';
import CardActions from '@mui/material/CardActions';
import CardMedia from '@mui/material/CardMedia';
import Typography from '@mui/material/Typography';
import SchoolIcon from '@mui/icons-material/School';
import { Badge, Grid } from '@mui/material';
import NotificationsIcon from '@mui/icons-material/Notifications';

const useStyles = makeStyles({
  root: {
    width:250,
    margin: 30,
  },
  media: {
    height: 170,
    opacity: 0.5,
    backgroundColor: "#000",
  },
  nombreCurso: {
      fontSize: 20,
      width: 230,
      color: "#FFF",
      position: "absolute",
      textAlign: "center",
      top: 70,
      marginLeft: 10,
      fontFamily: "Cocogoose",
  },
  fondoNegro: {
      backgroundColor: "#000",
  },
  footerCaja: {
      padding: 20,
      margin: "auto",
      textAlign: "center",
  },
  barraNegra: {
    height: 10,
    background: "linear-gradient(to left, rgb(226, 0, 0) , rgb(255, 130, 50))",
  },
  promedio: {
    fontFamily: 'Helvetica',
    background: "linear-gradient(to left, rgb(226, 0, 0) , rgb(255, 130, 50))",
  },
  btnDiploma: {
    padding: 5,
    paddingLeft:20,
    paddingRight:20,
    borderRadius:10,
    marginTop:10,
    background: 'rgb(204, 53, 2)',
    color:'#FFF',
    fontWeight:'bolder',
    transition: '0.5s',
    '&:hover':{
      transition: '0.5s',
      background: 'rgb(253, 119, 74)',
      color:'#000',
      textDecoration: 'none',
    }
  }
});

export default function MediaCard(props) {
  const classes = useStyles();

  const [notification, setNotification] = React.useState(null);
  const [diploma, setDiploma] = React.useState(null);

  React.useEffect(() => {
    if (props.curso.notification != 0) {
      setNotification(
        <Grid
          container
          direction="row"
          justify="center"
          alignItems="flex-start"
        >
          <Badge anchorOrigin={{ vertical: 'bottom', horizontal: 'left',}} badgeContent={props.curso.notification} color="secondary">
            <NotificationsIcon style={{fontSize:40}} color="secondary" />
          </Badge>
      </Grid>
      );
    }
    if (props.curso.diploma != null) {
      setDiploma(
        <Grid
          container
          direction="column"
          justify="center"
          alignItems="center"
        >
          <Grid item>

            <SchoolIcon style={{fontSize:60,color:'rgb(204, 0, 0)'}} />
          </Grid>
          <Grid item>

            <a className={classes.btnDiploma} target="_blank" href={"/see-diplom/received/"+props.curso.id}>Ver diploma</a>
          </Grid>
        </Grid>
      );
    }
  },[])

  return (
      
    <Card className={classes.root}>
      <CardActionArea>
        <div className={classes.fondoNegro}>
            <CardMedia
            className={classes.media}
            image={props.curso.url_img}
            title={props.curso.nombre}
            />
          <Typography gutterBottom variant="h5" component="h2" className={classes.nombreCurso}>
          
            
            {props.curso.nombre}
          
          </Typography>
        </div>
        <div className={classes.barraNegra} ></div>
      </CardActionArea>
      
      <Grid
        container
        className={classes.promedio}
        direction="row"
        justify="center"
        alignItems="center"
      >
        <h5 className="mb-2">Promedio actual: <strong style={{color: '#000'}}> {props.curso.promedio.toFixed(1)} </strong></h5>
      </Grid>
      {notification}
      {diploma}
      <CardActions className={classes.CardActions}>
            <div className="fondo-boton-ingresar col-12">
                
            <button 
                className="boton-ingresar cocogose"
                onClick={() => window.location.replace("/VerCurso/"+props.curso.id)}
            >Ingresar</button>
            </div>
      </CardActions>
    </Card>
  );
}