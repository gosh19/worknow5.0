import React, { Component } from 'react';
import CanvasJSReact from './../../../canvasJs/canvasjs.react';
import { Button } from '@mui/material';

import SelectMeses from './SelectMeses';

var CanvasJSChart = CanvasJSReact.CanvasJSChart;

export default class Graficos extends Component {
    constructor(props){
        super(props),
        this.state = {
            vendedoras: [], 
            mes: '',
            tipoGrafico: 0,
            ArrayCursos: [],
        }

        this.setVendedoras = this.setVendedoras.bind(this);
        this.handleChangeMes = this.handleChangeMes.bind(this);
        this.setCantidades = this.setCantidades.bind(this);
        this.setCursos = this.setCursos.bind(this);
    }

    handleChangeGraph(){
        
        this.setState((prevState, props) => {
            let tipo = parseInt(prevState.tipoGrafico);
            tipo++;
            
            if (tipo >2) {
                tipo = 0;
            }
            return{
                tipoGrafico: tipo,
            }
            });
    }

    handleChangeMes(valueMes){        

        this.setVendedoras(valueMes);
        this.setCursos(valueMes);
    }

    componentDidMount(){
        
        this.setVendedoras();
        this.setCursos();

    }
    
    setVendedoras(mes = null){
        let url ='/get-vendedoras';

        if (mes != null) {
            url = url+'/'+mes;
        }

        fetch(url)
        .then(response => response.json())
        .then(datos => {
            
            this.setState((state, props) => {               
                const mesNombre = '';

                if (datos.length != 0) {
                    const mesNombre = datos[0].mes;
                }

                return {
                    vendedoras: datos,
                    mes: mesNombre
                }
            })
        })
    }

    setCursos(mes = -1){

        let url = '/get-users-month';

        if (mes != -1) {
            url = url+'/'+mes;
        }

        fetch(url)
        .then(response => response.json())
        .then(info => {
            let cursos = new Array();
            let acumuladoCursos = new Array();
            info.map((user) => {
                user.courses.map((curso) => {
                    const index = cursos.findIndex(AuxCurso => AuxCurso.label == curso.nombre);
                    const index2 = acumuladoCursos.findIndex(AuxAcumulado => AuxAcumulado.name == curso.nombre);
                    if (curso.nombre != "Introduccion al Marketing Digital") {
                        if (index == -1) {
                            cursos.push({label: curso.nombre, y: 1, acumulado:10});
                            let cuota = 0;
                            if (user.info_fac != null) {
                                cuota = user.info_fac.monto_cuota;
                            }
                            acumuladoCursos.push({name:curso.nombre, acumulado: cuota});
                        }else{
                            cursos[index].y++;
                            if ((acumuladoCursos[index2] != null) && (user.info_fac != null)) {
                                
                                acumuladoCursos[index2].acumulado = acumuladoCursos[index2].acumulado + user.info_fac.monto_cuota;
                            }
                        }
                    }
                })
            });
            cursos.map((curso,index) => {
                curso.label = curso.label+'($ '+new Intl.NumberFormat().format(acumuladoCursos[index].acumulado*(0.89))+')';
            });
            this.setState((prevState) => {
                return{
                    ArrayCursos: cursos,
                }
            })
            
        })
    }

    setCantidades(vendedoras){
        let arrayCantidades = new Array(0, 0, 0,0,0);
        if (vendedoras != null) {
            
            vendedoras.map((vendedora, index) => {

                vendedora.ventasAlta.map((venta, index) => {                    
                    switch (venta.datos_alumno.tipo_pago) {
                        case 'credito':
                            arrayCantidades[0]++;
                            break;    
                        case null:
                            arrayCantidades[0]++;
                            break; 
                        case 'efectivo':
                            arrayCantidades[1]++;
                            break;
                        case 'efectivoTotal':
                            arrayCantidades[2]++;
                            break;
                        default:
                            break;
                    }

                    if (venta.datos_alumno.kit) {
                        arrayCantidades[3]++;
                    }
                    if (venta.datos_user != null) {
                        if (venta.datos_user.country == 'UY') {
                            arrayCantidades[4]++;
                        }
                    }
                    
                })
            });
            return arrayCantidades;
        }
        return [0,0,0];
    }

    render() {  

        let txtButton = 'Ver por vendedora';
        let datosGraphVendedoras = new Array();
        let datosGraphVentas = new Array();
        let data = new Array();
        let cantidades = this.setCantidades(this.state.vendedoras);

        
        let arrayNombreVenta = new Array('Credito', 'Efectivo', 'EfectivoTotal', 'Kit', 'Uruguay');


        this.state.vendedoras.map((vendedora, index) => {
            datosGraphVendedoras.push({ label: vendedora.name,  y: vendedora.ventasAlta.length  })
        });

        cantidades.map((cant, index) => {
            datosGraphVentas.push({ label: arrayNombreVenta[index],  y: cant  });
        });

        switch (this.state.tipoGrafico) {
            case 0:
                data = datosGraphVentas;
                
                txtButton = 'Ver por cursos';
                
                break;
            case 1:
                data = this.state.ArrayCursos;
                
                txtButton = 'Ver por vendedora';
                
                break;
            case 2:
                data = datosGraphVendedoras;
                
                txtButton = 'Ver por tipo venta';
            
                break;
            default:
                break;
        }
        
        const options = {
			animationEnabled: true,
			exportEnabled: true,
			theme: "light2", // "light1", "dark1", "dark2"
			title:{
                
                title: "Cantidad Ventas",
			},
			axisY: {
				title: "Cantidad",
				includeZero: false,
				suffix: ""
			},
			axisX: {
				text: "",
				prefix: "",
			},
			data: [{
				type: "column",
				dataPoints: data,
            
			}]
        }
        

		return (
		<div>
            <Button
                variant="contained"
                color="primary"
                style={{marginLeft:30}}
                onClick={() => this.handleChangeGraph()}
            >
                {txtButton}
            </Button>
            <SelectMeses valueMes={this.handleChangeMes} />
			<CanvasJSChart options = {options} />

		</div>
		);
    }
}


