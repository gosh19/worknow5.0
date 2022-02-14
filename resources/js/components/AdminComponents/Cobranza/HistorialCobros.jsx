import React, { Component } from 'react'
import { Grid, Button, CircularProgress } from '@mui/material';
import EnhancedTable from './EnhancedTable';

export default class HistorialCobros extends Component {
    constructor(props){
        super(props);
        this.state ={
            cobros: [],
            meses: [1,2,3,4,5,6,7,8,9,10,11,12],
            total: 0,
            selectedMes: (new Date().getMonth())+1,
            descuento: 0.11,
            loaded: false,

        }
        this.handleChange = this.handleChange.bind(this);
        this.loadingRender = this.loadingRender.bind(this);
        this.getCobros = this.getCobros.bind(this);
        this.getCobros();
    }

    handleChange(event){        
        var number =event.target.value;
        this.setState(() => {
            return{
                descuento: number,
            }
        })
    }

    loadingRender(){
        if (!this.state.loaded) {
            return <Grid
                        container
                        justify="center"
                        alignItems="center"
                        alignContent="center"
                        className="mb-3 mt-3 "
                    >
                        <Grid 
                            item
                            style={{
                                background: "#E3C3CC",
                                borderRadius:10,
                                padding:10,
                                marginRight: 10,
                                color: " #FFF"
                            }}
                        >
                            <h3> Loading...</h3>
                        </Grid>
                        <CircularProgress color="secondary" />
                    </Grid>

        }
        return null;
    }

    getCobros(mes = -1){
        let url ='/get-cobros-hechos';

        if (mes != -1) {
            url = url+'/'+mes;
            this.setState(() => {
                return {
                    total: 0,
                    selectedMes: mes,
                }
            })
        }

        this.setState((prevState) => {
            if (prevState.loaded) {
                return {
                    loaded: false,
                }
            }
        })            
        
        fetch(url)
        .then(response => response.json())
        .then(info => {
            if (this.state.total != 0 ) {
            
                this.setState(() => {
                    return {
                        total: 0,
                    }
                })
            }

            this.setState((prevState,props) => {
                return{
                    cobros: info.cobros,
                    total: info.total,
                    loaded: !prevState.loaded,
                    
                }
            })
         });

    }

    render() {

        return (
            <div>
                <Grid
                    container
                    justify="center"
                    alignItems="center"
                    alignContent="center"
                    className="mb-3 mt-3 "
                >
                    {this.state.meses.map((mes) => {
                        return <Button 
                                    key={mes}
                                    style={{marginRight:15}} 
                                    variant="contained" 
                                    color="primary" 
                                    onClick={() => this.getCobros(mes)}
                                >{mes} </Button>
                    })
                    }
                    
                </Grid>
                
                <Grid
                    container
                    justify="center"
                    alignItems="center"
                    alignContent="center"
                    className="mb-3 mt-3"
                >
                    
                    <Grid item>

                        <h4 htmlFor="descuento">Descuento : </h4>
                        %<input 
                            style={{
                                width: 70,
                                border: "1px solid #01A9DB",
                                borderRadius: 10,
                                padding:10,
                            }}
                            id="descuento"
                            type="number" 
                            value={this.state.descuento} 
                            onChange={this.handleChange}
                            />
                    </Grid>
                </Grid>
                <Grid
                    container
                    justify="center"
                    alignItems="center"
                    alignContent="center"
                    className="mb-3 mt-3"
                >
                    <h3>Total del mes: ${new Intl.NumberFormat().format(this.state.total*(1-this.state.descuento))},00</h3>
                </Grid>
                <Grid item>
                        <Button 
                            variant="contained" 
                            color="secondary" 
                            className="w-100"
                            href={"/download-cobros/"+this.state.selectedMes}
                        >Descargar facturas mes {this.state.selectedMes} </Button>
                    </Grid>
                    
                        {this.loadingRender()}

                <Grid
                    container
                    justify="center"
                    alignItems="center"
                    alignContent="center"
                    className="mb-3 mt-3 tabla-historial"
                >

                <EnhancedTable descuento={1-this.state.descuento} cobros={this.state.cobros} />

                </Grid>
            </div>
        )
    }
}
