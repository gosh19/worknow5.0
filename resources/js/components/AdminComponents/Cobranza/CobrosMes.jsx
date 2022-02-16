import React, { Component } from 'react'
import { Button, Grid, Modal } from '@mui/material';

import FormCobroAlumno from './FormCobroAlumno';
import TablaCobros2 from './TablaCobros2';
import { ThemeProvider, createTheme } from '@mui/material/styles';

const theme = createTheme();

export default class CobrosMes extends Component {
    constructor(props) {
        super(props);
        this.state = {
            user: document.getElementById('user').value,
            dataCobro: null,
            userIndex: null,
            delete: false,
            cobros: [],
            meses: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            facturacionUser: null,
            openModalCobro: true,
            selectedMonth: -1,
            cuentas: [],
        }
        this.renderPanelCobro = this.renderPanelCobro.bind(this);
        this.cobroCargado = this.cobroCargado.bind(this);
        this.setUser = this.setUser.bind(this);
        this.getCobros = this.getCobros.bind(this);
        this.getCobros();
        this.getCuentas = this.getCuentas.bind(this);
        this.getCuentas();

        this.handleClosemodalCobro = this.handleClosemodalCobro.bind(this);

    }

    getCuentas() {

        fetch('/get-cuentas')
            .then(response => response.json())
            .then(info => {
                this.setState({ cuentas: info });
            })
            .catch(error => console.log(error));
    }

    handleClosemodalCobro() {
        console.log('cerr');

        this.setState((state) => {
            return {
                openModalCobro: false,
            }
        })
    }

    renderPanelCobro() {

        if (this.state.user != '') {

            return (
                <Modal
                    open={this.state.openModalCobro}
                    onClose={this.handleClosemodalCobro}
                    aria-labelledby="simple-modal-title"
                    aria-describedby="simple-modal-description"
                    mountonEnter
                    unmountOnExit
                >

                    <FormCobroAlumno
                        key={this.state.user.id}
                        user={this.state.user}
                        cuentas={this.state.cuentas}
                        cobroCargado={this.cobroCargado}
                    />
                </Modal>
            );
        }
        return null;
    }

    setUser(id, index, infoFac) {

        fetch('/get-user/' + id)
            .then(response => response.json())
            .then(info => {
                this.setState((state, props) => { return { user: info, userIndex: index, facturacionUser: infoFac, openModalCobro: true } });
            });
        this.getCobros(-2);
    }

    shouldComponentUpdate(nextProps, nextState) {

        if ((this.state.cobros !== nextState.cobros)
            || (this.state.userIndex !== nextState.userIndex)
            || (this.state.openModalCobro != nextState.openModalCobro)
        ) {
            return true;
        }
        return false;
    }

    getCobros(mes = -1) {
        let url = '/get-cobros-mes';

        if (mes == -2) {
            if (this.state.selectedMonth != -1) {

                url = url + '/' + this.state.selectedMonth;
            }
        } else if (mes != -1) {
            url = url + '/' + mes;
            this.setState({ selectedMonth: mes });
        }

        fetch(url)
            .then(response => response.json())
            .then(info => {

                this.setState((state, props) => {
                    return {
                        cobros: info,
                    }
                })
            });
    }

    /**
     * Al cargar el cobro desmonta el panel de cobro alumno
     * recibe un parametro para determinar si debe eliminar el elemento de la fila o no
     */
    cobroCargado(deleteElement) {
        window.history.pushState("", "", "/Cobro");

        let arrAux = this.state.cobros;

        if (deleteElement) {
            arrAux.splice(this.state.userIndex, 1);

        }

        this.setState((state, props) => {
            return {
                user: '',
                cobros: arrAux,
                userIndex: null,
            }
        });
        this.handleClosemodalCobro();

    }

    componentDidMount() {
        if (this.state.user != '') {
            this.setState({ user: JSON.parse(this.state.user) });

        }
    }


    render() {

        return (
            <div>
                <ThemeProvider theme={theme}>


                    {this.renderPanelCobro()}
                </ThemeProvider>
                <h3>Cobros del mes </h3>
                <hr />
                <Grid
                    container
                    justify="center"
                    alignItems="center"
                    alignContent="center"
                    className="mb-3 mt-3"
                >
                    {this.state.meses.map((mes) => {
                        return <Button
                            key={mes}
                            style={{ marginRight: 15 }}
                            variant="contained"
                            color="primary"
                            onClick={() => this.getCobros(mes)}
                        >{mes} </Button>
                    })
                    }
                </Grid>
                <ThemeProvider theme={theme}>

                    <TablaCobros2
                        key={this.state.userIndex}
                        userIndex={this.state.userIndex}
                        setUser={this.setUser}
                        selectedMonth={this.state.selectedMonth}
                        modificarFondos={this.modificarFondos}
                        cobros={this.state.cobros}
                    />
                </ThemeProvider>
            </div>
        )


    }
}



