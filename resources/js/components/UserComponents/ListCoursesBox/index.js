import React from 'react';
import ReactDOM from 'react-dom';
import { Grid, CircularProgress, Button, Modal, } from '@mui/material';
import { ThemeProvider, createTheme } from '@mui/material/styles';

import MediaCard from './MediaCard';
import InfoEnvio from './InfoEnvio';

const theme = createTheme();



class ListCoursesBox extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            cursos: [],
            msjError: <CircularProgress />,
            kitInfo: null,
            egresado: false,
        }
        this.setCursos = this.setCursos.bind(this);
        this.recargarFetch = this.recargarFetch.bind(this);
        this.setInfoKit = this.setInfoKit.bind(this);
        this.renderInfoKit = this.renderInfoKit.bind(this);
        this.renderModalEgresado = this.renderModalEgresado.bind(this);
        this.handleClose = this.handleClose.bind(this);
    }

    

    recargarFetch() {
        this.setState({ msjError: <CircularProgress /> });
        this.setCursos();
    }

    setCursos() {

        fetch('/get-cursos')
            .then(response => response.json())
            .then(responseCursos => {

                if (responseCursos.length != 0) {
                    let egresadoValue = false;

                    for (let index = 0; index < responseCursos.length; index++) {
                        if (responseCursos[index].diploma != null) {
                            if (responseCursos[index].diploma.visto == 0) {
                                egresadoValue = true;
                            }

                        }

                    }

                    this.setState((state, props) => {
                        return {
                            cursos: responseCursos,
                            msjError: null,
                            egresado: egresadoValue,
                        }
                    })
                } else {
                    this.setState((state, props) => {
                        return {
                            msjError: <h1>No hay cursos cargados...</h1>,
                        }
                    })
                }
            }
            )
            .catch(error => {
                this.setState({
                    msjError:
                        <Grid
                            container
                            className="alert alert-danger p-3 text-center"
                            style={{
                                justifyContent: "center",
                            }}
                        >
                            <h3 className="mr-3">{"Pareciera que tu internet tiene una demora mayor a la esperada"}</h3>

                            <h3>
                                <p>

                                    En caso de no poder ver sus cursos diponibles presione en el siguiente boton para ir a una version mas liviana
                                </p>
                                <a className="btn btn-danger btn-block font-weight-bolder" href="/User/1/1"> Ir a la version Lite </a>
                            </h3>
                        </Grid>
                });
            });
    }

    setInfoKit() {
        fetch('/get-info-kit')
            .then(response => response.json())
            .then(info => {

                if (info.estado) {
                    this.setState(() => { return { kitInfo: info.kit } });
                }
            });
    }

    handleClose() {
        this.setState({ egresado: false });
    }

    renderModalEgresado() {
        if (!this.state.egresado) {
            return null;
        }
        const modalEgresado =
            <Modal open={this.state.egresado} onClose={this.handleClose} >
                <Grid
                    container
                    justify="center"
                    alignItems="baseline"

                >
                    <Grid style={{ width: "50%" }} item>

                        <img width="100%" src="https://media0.giphy.com/media/h3pE4DxsatJWFoSMUu/giphy.gif?cid=ecf05e4750a8ea55f588c7095577dcb4a7df6aeaa89bd942&rid=giphy.gif" />
                    </Grid>
                    <Button onClick={this.handleClose} variant="contained" color="secondary">X</Button>
                </Grid>
            </Modal>;
        return modalEgresado;
    }

    renderInfoKit() {
        if (this.state.kitInfo != null) {

            return (
                <Grid
                    container
                    justify="center"
                    style={{
                        padding: 10,
                        border: '1px solid #C7C7C7',
                        borderRadius: 10,
                        color: '#FFF',
                        marginBottom: 20,
                    }}
                >
                    <ThemeProvider theme={theme}>
                        <InfoEnvio title="Kit de herramientas" 
                                    info={this.state.kitInfo} 
                                    numEnvio={this.state.kitInfo.codigo_seguimiento}
                        />
                    </ThemeProvider>
                </Grid>
            );
        }
        return null;
    }

    componentDidMount() {
        this.setCursos();
        this.setInfoKit();
    }

    render() {


        return (
            <div>
                <h1 style={{ fontSize: "35px" }} className="text-center cocogose text-red mb-3">Cursos disponibles</h1>
                {this.renderInfoKit()}
                {this.renderModalEgresado()}
                <Grid
                    container
                    justify="center"
                >
                    <Grid item>


                    </Grid>
                </Grid>
                <Grid
                    container
                    justify="center"
                >
                    {this.state.cursos.map((curso, index) => {
                        return (
                            <Grid item>

                                <MediaCard
                                    key={index}
                                    notification={curso.notification}
                                    curso={curso}
                                />
                            </Grid>
                        )
                    })}
                    {this.state.msjError}
                </Grid>
            </div>
        )
    }
}

if (document.getElementById('courses-box')) {
    ReactDOM.render(
        <ListCoursesBox />,
        document.getElementById('courses-box')
    );
}