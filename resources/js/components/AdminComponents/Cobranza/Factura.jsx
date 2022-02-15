import React from 'react';
import { makeStyles } from '@mui/styles';
import { Button, Input, CircularProgress } from '@mui/material';
import CheckBoxIcon from '@mui/icons-material/CheckBox';
import HighlightOffIcon from '@mui/icons-material/HighlightOff';

const useStyles = makeStyles((theme) => ({
        input:{
            border: "1px solid #58ACFA",
        },
        iconCheck:{
            color: "#088A08",
        },
        iconError: {
            color: "#8A0808",
        }
    })
);



export default function DatosAlumno(props) {
  const classes = useStyles();

  const [factura, setFactura] = React.useState('');
  const [exist, setExist] = React.useState(false);
  const [icon, setIcon] = React.useState(<HighlightOffIcon className={classes.iconError} />);

  React.useEffect(() => {
      if (props.user.factura != null) {

          setFactura(props.user.factura);
          setIcon(<CheckBoxIcon className={classes.iconCheck} />);
          setExist(true);
      }else{
      }
  }, [])


  function handleInputChange(e) {
      let value = e.target.value;
      setFactura(value);
  }

  function handleKeyDown(e) {
    if ((e.key === 'Enter')) {
        if (exist) {
            setIcon(<CircularProgress />);
        }
        let url = '/cargar-factura/'+props.user.id;
        if (factura != null) {            
            url = url+'/'+factura;
        }
        
        fetch(url)
        .then(response => response.json())
        .then(info => {
            if (info.estado) {
                setExist(true);
                setIcon(<CheckBoxIcon className={classes.iconCheck} />);
                if (info.vacio){                  
                    setIcon(<HighlightOffIcon className={classes.iconError} />);    
                }
            }
        })
        .catch(() => {
            setIcon(<div><small>error</small><HighlightOffIcon className={classes.iconError} /></div>);  
        })
    }
  }
  
  return(
      <div>
        <Input onKeyDown={handleKeyDown} onChange={handleInputChange} className={classes.input} value={factura} />
        {icon}
      </div>
  );
}