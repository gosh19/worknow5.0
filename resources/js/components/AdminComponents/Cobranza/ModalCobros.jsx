import React from 'react';
import { makeStyles } from '@mui/material/styles';
import Modal from '@mui/material/Modal';
import Backdrop from '@mui/material/Backdrop';
import Fade from '@mui/material/Fade';

const useStyles = makeStyles(theme => ({
  modal: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  paper: {
    backgroundColor: theme.palette.background.paper,
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
    maxHeight: '90%', 
    overflow: 'auto',
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
}));

export default function ModalVentas(props) {
  const classes = useStyles();
  const [open, setOpen] = React.useState(true);


  const handleClose = () => {
    props.action(false);
    setOpen(false);
  };

  const renderVentas = () => {
      
      return <div>
          <table className="table">
              <thead>
                  <tr>

                    <th scope="row" >#</th>
                    <th scope="row" >Nombre</th>
                    <th scope="row" >Email</th>
                    <th scope="row" >Tipo Pago</th>
                  </tr>
              </thead>
              <tbody>

              </tbody>
          </table>
      </div>
  }

  return (
    <div>
      <Modal
        aria-labelledby="transition-modal-title"
        aria-describedby="transition-modal-description"
        className={classes.modal}
        open={open}
        onClose={handleClose}
        closeAfterTransition
        BackdropComponent={Backdrop}
        BackdropProps={{
          timeout: 500,
        }}
      >
        <Fade in={open}>

                <div className={classes.paper}>
                    {renderVentas()}

            </div>
        </Fade>
      </Modal>
    </div>
  );
}
