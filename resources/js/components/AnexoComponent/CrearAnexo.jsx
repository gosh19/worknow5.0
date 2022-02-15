import React from 'react';
import { makeStyles } from '@mui/styles';
import Fade from '@mui/material/Fade';
import { Grid, TextField, FormControlLabel, Radio, RadioGroup, FormControl } from '@mui/material';
import swal from 'sweetalert';

const useStyles = makeStyles(theme => ({
  modal: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  paper: {
    backgroundColor: theme.palette.background.paper,
    border: '1px solid #BDBDBD',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
  },
  botonCrearAnexo:{
    padding: 10,
    background: '#0000FF',
    color:'#FFF',
    border:0,
    borderRadius:10,
    margin:'auto'
  },
  botonCancelar:{
    padding: 10,
    background: '#FF0000',
    color:'#FFF',
    border:0,
    borderRadius:10,
  },
  textArea: {
      margin:10,
  },
  botonSeleccionarCurso:{
    padding: 10,
    background: '#B40404',
    color:'#FFF',
    border:0,
    borderRadius:10,
    margin: 15,
  }
}));

export default function TransitionsModal() {
  const classes = useStyles();
  const [open, setOpen] = React.useState(false);
  const [name, setName] = React.useState();
  const [descripcion, setDescripcion] = React.useState();
  const [curso_id, setCursoId] = React.useState();
  const [cursos, setCursos] = React.useState([]);
  const [value, setValue] = React.useState();

  const handleOpen = () => {
    setOpen(!open);
  };
  const handleNameChange = () => {
      setName(event.target.value);
  };
  const handleDescChange = () => {
    setDescripcion(event.target.value);
    };


    const handleChange = event => {
        console.log(event.target.value);
        
        setValue(event.target.value);
        setCursoId(parseInt(event.target.value, 10));
      };

    React.useEffect(() => {
        fetch('/get-all-cursos')
        .then(response => response.json())
        .then(info => {
            setCursos(info);
        })
    }, [])

  function cargarAnexo() {
      const data = {
          'name': name,
          'descripcion': descripcion,
          'course_id': curso_id
      };

      fetch('/Anexo',{
          method: 'POST',
          credentials: 'same-origin',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          body: JSON.stringify(data)
      })
      .then(response =>  response.json())
      .then(info => {
          console.log(info);
          if (info.estado) {
              
              swal('Excelente!', 'Anexo creado con exito','success');
              setDescripcion();
              setName();
        }else{
           // swal('Error', info.error[0],'error');
        }
      })
  }
  return (
    <div>
        <h3>Presione aqui para crear un nuevo anexo</h3>
        <Grid
            container
            justify="center"
        >
            <button className={classes.botonCrearAnexo} type="button" onClick={handleOpen}>
                Crear Anexo
            </button>
        </Grid>
        <hr/>

        <Fade in={open} mountOnEnter unmountOnExit>
          <div className={classes.paper}>
              <Grid
                container
                justify="center"
              >
                <h2 id="transition-modal-title">Completa los campos</h2>
                <TextField onChange={handleNameChange} className={classes.textArea} fullWidth variant="outlined" label="Nombre" />
                <TextField onChange={handleDescChange} className={classes.textArea} fullWidth variant="outlined" multiline label="Descripcion" />
                <hr/>
                <Grid
                    container
                    justify="center"
                >
                    <FormControl component="fieldset">
                    <RadioGroup aria-label="gender" name="gender1" value={value} onChange={handleChange}>
                    {cursos.map((curso, index) => {
                        return <FormControlLabel  
                                    key={index} 
                                    value={curso.id.toString()} 
                                    control={<Radio />} 
                                    label={curso.nombre+' '+curso.id}
                                />
                        })
                    }
                    </RadioGroup>
                    </FormControl>
                </Grid>
                    <button className={classes.botonCrearAnexo} type="button" onClick={cargarAnexo}>
                        Cargar
                    </button>
                    <button className={classes.botonCancelar} type="button" onClick={handleOpen}>
                        Cancelar
                    </button>

              </Grid>
          </div>
        </Fade>
    </div>
  );
}


