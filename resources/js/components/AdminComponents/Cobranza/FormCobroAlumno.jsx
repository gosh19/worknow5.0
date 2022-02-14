import React from 'react'
import { TextField, Grid, FormControl, InputLabel, Select, MenuItem, Button, IconButton, Collapse, Grow, CircularProgress } from '@mui/material';
import { makeStyles } from '@mui/material/styles';
import clsx from 'clsx';

import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import  swal  from 'sweetalert';

import DatosAlumno from './DatosAlumno';


const useStyles = makeStyles(theme => ({
    formControl: {
      margin: theme.spacing(1),
      minWidth: 300,
    },
    selectEmpty: {
      marginTop: theme.spacing(2),
    },
    inputCobro:{
        margin: theme.spacing(1),
        width:300,
    },
    cajaCobro: {
        display:"block",
        background: "#FFF",
        margin:"auto",
        marginTop:20,
        maxWidth:"80%", 
        maxHeight:'100%',
        border: "3px solid #BDBDBD",
        padding:15,
        borderRadius:15,
        overflowY:'scroll',
    },
    botonForm:{
        marginTop: 10,
        width: 200,
    },
    botonCancelar:{
        marginTop: 10,
        width: 200,
        marginLeft:15,
        background: '#B40404', 
        color: '#FFF',
    },
    expandIcon:{
        fontSize:60,
    },
    expand: {
    
        color: '#0080FF',
        transform: 'rotate(0deg)',
        marginLeft: 'auto',
        transition: "0.5s",
      },
      expandOpen: {
        color: '#FF0000',
        transform: 'rotate(180deg)',
      },
  }));



export default function FormCobroAlumno(props){
    const classes = useStyles();
    const [selectCuenta, setValueSelect] = React.useState(1);
    const [cuentas, setCuentas] = React.useState([]);
    const [valueTipocobro, setvalueTipocobro] = React.useState(0);
    const [fecha, setFecha] = React.useState();
    const [numOperacion, setnumOperacion] = React.useState();
    const [cantCuotas, setcantCuotas] = React.useState(1);
    const [monto, setmonto] = React.useState();
    const [expanded, setExpanded] = React.useState(false);
    const [cobrosUser, setcobrosUser] = React.useState([]);
    const [cuotasRestantes, setCuotasRestantes] = React.useState(6);
    const [loading, setLoading] = React.useState(false);
    
    function cargarCobro() {
        setLoading(true);

        const data = {
            'userId':props.user.id,
            'cuentaId': selectCuenta,
            'tipoCobro': valueTipocobro,
            'fecha':fecha,
            'numeroOperacion': numOperacion,
            'cantCuotas': cantCuotas,
            'monto': monto,
        }
    
        fetch('/Cobro',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            credentials: "same-origin",
            body: JSON.stringify(data)
        })
        .then(response =>  response.json())
        .then(info => {    
            if (info.estado == 1) {
                swal('Terminado', 'Cobro cargado con exito', 'success');
                props.cobroCargado(true);
                
            }else{
                
                swal("Error!", info.error.errorInfo[2], "error");

            }
            setLoading(false);
        });
    }

    const handleChangeCuenta = event => {
        setValueSelect(event.target.value);
    };
    const handleChangevalueTipocobro = event => {
        setvalueTipocobro(event.target.value);
    };
    const handleChangeFecha = event => {
        setFecha(event.target.value);
    };
    const handleChangenumOperacion = event => {
        setnumOperacion(event.target.value);
    };
    const handleChangecantCuotas = event => {
        setcantCuotas(event.target.value);
    };
    const handleChangemonto = event => {
        setmonto(event.target.value);
    };
    const handleExpandClick = () => {
        setExpanded(!expanded);
    };

    


    React.useEffect(() => {          
        setcobrosUser(props.user.cobros);
        setCuentas(props.cuentas);
        var f = new Date();
        setFecha(f.getFullYear()+"-"+ (f.getMonth() +1)+"-"+f.getDate());
        },[]);

    React.useEffect(() => {
        var cantCuotasCobradas = 0;
        var cuotasAdicionales = 0;
        if (typeof(props.user) != 'string') {
            setcobrosUser(props.user.cobros);

            props.user.cobros.map((cobro) =>{
                switch (cobro.tipo) {
                    case '0':         //CUOTA
                        cantCuotasCobradas = cantCuotasCobradas + cobro.cant_cuotas;
                        break;
                    case '1':         //CUOTA + ADICIONAL
                        cantCuotasCobradas = cantCuotasCobradas + (cobro.cant_cuotas*2);
                        break;
                    case '2':         //ADICIONAL
                        cantCuotasCobradas = cantCuotasCobradas + cobro.cant_cuotas;
                        break;
                    default:
                        break;
                }
                
            });
            props.user.adicionales.map((ad) => {
                cuotasAdicionales += ad.cant_cuotas;
            })
            setCuotasRestantes((props.user.info_fac.cant_cuotas +cuotasAdicionales )-cantCuotasCobradas);
            setmonto(props.user.info_fac.monto_cuota)
        }
        },[props.cuentas]);
    
    const renderBtnCargar = () =>{
        if (loading) {
            return <CircularProgress />
        }
        return(
            <Button
                color="primary"
                variant="contained"
                onClick={cargarCobro}
                className={classes.botonForm}
            >
                Cargar
            </Button>
        );
    }

    const renderAvisoAdicional = () => {
        if (props.user.adicionales.length != 0) {
            return(
                <div className="alert alert-danger">

                <p>El usuario tiene <b> adicionales</b>, recuerda seleccionar el <b> tipo de cobro </b> antes de cargar </p>
                </div>
            );
        }
        return null;
    }
        

    if (typeof(props.user) != 'string') {
 
        
    return (
        <Grow  in={true} timeout={{enter: 1000, exit: 1000,}}>
        <div className={classes.cajaCobro}>
        <Grid
                container
                direction="row"
                justify="center"
                alignItems="center"

            >

            <h3 style={{color:"#585858"}} >Cargar cobro para : <strong><a href={"/modificarAlumno?id="+props.user.id}> {props.user.name}</a></strong></h3>
            <IconButton
                className={clsx(classes.expand, {[classes.expandOpen]: expanded})}
                onClick={() =>handleExpandClick()}
            >
                <ExpandMoreIcon className={classes.expandIcon} />
            </IconButton>
            </Grid>
            <Collapse in={expanded} >
                <table className="table table-striped" >
                    <thead className="bg-dark text-white">
                        <tr>
                            <th scope="row" >#</th>
                            <th scope="row" >Monto</th>
                            <th scope="row" >Cuotas cobradas</th>
                            <th scope="row" >Tipo</th>
                            <th scope="row" >Num. Operacion</th>
                            <th scope="row" >Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    {cobrosUser.map((cobro) => {
                        let tipo = 'Cuota';
                        switch (cobro.tipo) {
                            case '0':         //CUOTA
                                 tipo = 'Cuota';
                                break;
                            case '1':         //CUOTA + ADICIONAL
                                 tipo = 'Cuota + Adicional';
                                break;
                            case '2':         //ADICIONAL
                                 tipo = 'Adicional';
                                break;
                            default:
                                break;
                        }
                                                    return <tr key={cobro.id} >
                                                                <th scope="row" >{cobro.id} </th>
                                                                <td>{cobro.monto} </td>
                                                                <td>{cobro.cant_cuotas} </td>
                                                                <td>{tipo}</td>
                                                                <td>{cobro.numero_operacion} </td>
                                                                <td>{cobro.fecha} </td>
                                                            </tr>
                                                    })}

                    </tbody>
                </table>

                
            </Collapse>
            <hr/>
            <h2>Faltan {cuotasRestantes} cuotas</h2>
            {renderAvisoAdicional()}
            <hr/>
            <Grid
                container
                direction="row"
                justify="space-between"
                alignItems="flex-start"
                
            >
                <Grid
                    item
                    
                >
                    <p>asd</p>
                    <DatosAlumno user={props.user} />
                </Grid>
                <Grid
                    item
                >
                    <Grid
                        container
                        direction="row"
                        justify="center"
                        alignItems="center"

                    >
                        <TextField
                            id="date"
                            variant="outlined"
                            value={fecha}
                            onChange={handleChangeFecha}
                            className={classes.inputCobro}
                        />
                        <Grid item>

                            <TextField 
                                id="numero_operacion" 
                                name="numero_operacion" 
                                label="Numero Operacion" 
                                variant="outlined" 
                                onChange={handleChangenumOperacion}
                                value={numOperacion}
                                className={classes.inputCobro}
                                />
                        </Grid>
                        
                    </Grid>
                    <Grid 
                        container
                        direction="row"
                        justify="center"
                        alignItems="center"
                    >

                            <TextField 
                                id="cuotas" 
                                name="cuotas" 
                                label="Cantidad de cuotas" 
                                type="number" 
                                variant="outlined" 
                                onChange={handleChangecantCuotas}
                                value={cantCuotas}
                                className={classes.inputCobro}
                                />
                            <Grid item>
                            <FormControl variant="filled" className={classes.formControl}>
                                <InputLabel id="demo-simple-select-filled-label">Cuenta</InputLabel>
                                <Select
                                labelId="demo-simple-select-filled-label"
                                id="demo-simple-select-filled"
                                value={selectCuenta}
                                onChange={handleChangeCuenta}
                                >
                                {cuentas.map((cuenta, index) => {                       
                                    return <MenuItem key={cuenta.id} value={cuenta.id}>{cuenta.name}</MenuItem>
                                })}
                                
                                </Select>
                            </FormControl>
                        </Grid>
                    </Grid>
                    <Grid
                        container
                        direction="row"
                        justify="center"
                        alignItems="center"

                    >
                        <Grid item >
                            <TextField 
                                id="monto" 
                                name="monto" 
                                label="Monto $$" 
                                type="number" 
                                variant="outlined" 
                                onChange={handleChangemonto}
                                value={monto}
                                className={classes.inputCobro}
                            />
                        </Grid>
                        <Grid item>
                            <FormControl variant="filled" className={classes.formControl}>
                                <InputLabel id="demo-simple-select-filled-label">Tipo</InputLabel>
                                <Select
                                    labelId="demo-simple-select-filled-label"
                                    id="demo-simple-select-filled"
                                    value={valueTipocobro}
                                    onChange={handleChangevalueTipocobro}
                                >
                                    <MenuItem key={1} value={0}>Cuota</MenuItem>
                                    <MenuItem key={2} value={1}>Cuota + Adicional</MenuItem>
                                    <MenuItem key={2} value={2}>Adicional</MenuItem>
                                </Select>
                            </FormControl>
                        </Grid>
                    </Grid>
                    <hr/>
                    <Grid
                        container
                        direction="row"
                        justify="center"
                        alignItems="center"

                    >
                        <Grid item >
                            {renderBtnCargar()}
                            <Button
                                variant="contained"
                                className={classes.botonCancelar}
                                onClick={() => props.cobroCargado(false)}
                            >
                                Cancelar
                            </Button>
                        </Grid>
                        
                    </Grid>
                    {/** */}
                </Grid>
                
            </Grid>

            

        <hr/>
        </div>
        </Grow >
    )
                    }
                    return(<CircularProgress />)
}
