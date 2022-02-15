import React from 'react';
import { makeStyles } from '@mui/styles';

import clsx from 'clsx';
import Card from '@mui/material/Card';
import CardHeader from '@mui/material/CardHeader';
import CardContent from '@mui/material/CardContent';
import CardActions from '@mui/material/CardActions';
import Avatar from '@mui/material/Avatar';
import IconButton from '@mui/material/IconButton';
import MoreVertIcon from '@mui/icons-material/MoreVert';
import CameraIcon from '@mui/icons-material/Camera';
import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';

import NestedList from './NestedList';
import ModalVentas from './ModalVentas';

const useStyles = makeStyles(theme => ({
  root: {
    maxWidth: 345,
  },
  media: {
    height: 0,
    paddingTop: '56.25%', // 16:9
  },
  expand: {
    
    color: '#0080FF',
    transform: 'rotate(0deg)',
    marginLeft: 'auto',
    transition: "1s",
  },
  expandOpen: {
    color: '#FF0000',
    transform: 'rotate(360deg)',
  },
  avatarUno: {
    backgroundColor: "#B40404",
  },
  avatarDos: {
    backgroundColor: "#0431B4",
  },
}));



export default function CardVendedora(props) {
  const classes = useStyles();
  const [expanded, setExpanded] = React.useState(false);
  const [modal, setModal] = React.useState(null);

  let valor = false;
  const handleExpandClick = (valor) => {
    
    
    setExpanded(valor);
    if (valor) {
      setModal(<ModalVentas ventas={props.ventasAlta} action={handleExpandClick} />);
    }
    else{
      setModal(null);
    }
  };
  
  const parImp = (props.index%2)? classes.avatarUno: classes.avatarDos;

  
  return (
    <Card className={classes.root}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={parImp}>
            {props.letter}
          </Avatar>
        }
        action={
          <IconButton aria-label="settings">
            <MoreVertIcon />
          </IconButton>
        }
        title={<a href={"/show-vendedora/"+props.vendedora.id}> {props.vendedora.name}</a>}
        subheader={props.vendedora.email}
      />
      <CardContent>
        <NestedList
            ventasAlta={props.ventasAlta}
            ventasBaja={props.ventasBaja}
            objetivo={props.objetivo}
            rendimiento={props.vendedora.rendimiento}
            puntos={props.vendedora.puntos}
         />
      </CardContent>
      <hr />
      <CardActions disableSpacing>
        <div className="d-flex justify-content-right" style={{color: "#58ACFA"}} >
          <h5>Presiona para ver las ventas</h5>
          <ArrowForwardIosIcon />
        </div>
        <IconButton
          className={clsx(classes.expand, {
            [classes.expandOpen]: expanded,
          })}
          onClick={() =>handleExpandClick(!valor)}
          aria-expanded={expanded}
          aria-label="show more"
        >
          <CameraIcon />
        </IconButton>
      </CardActions>
      {modal}

    </Card>
  );
}