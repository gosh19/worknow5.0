import React, { Component } from 'react';
import ReactDOM from 'react-dom';
/* App.js */
import CanvasJSReact from './../../../canvasJs/canvasjs.react';
import SelectMeses from './SelectMeses';
import { CircularProgress } from '@mui/material';

var CanvasJS = CanvasJSReact.CanvasJS;
var CanvasJSChart = CanvasJSReact.CanvasJSChart;

export default class LiquidacionMes extends Component {
	constructor(props) {
        super(props);
        this.state ={
            vendedoras: [],
            mes: '',
            arrayCant: [],
            objetivo: 21,
            mesView: props.mesView,
        }
        this.toggleDataSeries = this.toggleDataSeries.bind(this);
        this.setVendedoras = this.setVendedoras.bind(this);
        this.handleChangeMes = this.handleChangeMes.bind(this);
        this.setCantidades = this.setCantidades.bind(this);
		this.createData = this.createData.bind(this);
        this.dataColumns = this.dataColumns.bind(this);
        this.renderComisiones = this.renderComisiones.bind(this);
    }
    
    handleChangeMes(valueMes){        

        this.setVendedoras(valueMes);
    }

    componentDidMount(){
        
        this.setVendedoras();
    }

    
    setVendedoras(mes = null){
        let url ='/get-vendedoras';

        if (mes != null) {
            url = url+'/'+mes;
        }
        if (this.state.mesView != null) {
            const date = new Date();
            url = url+'/'+date.getMonth();
        }

        fetch(url)
        .then(response => response.json())
        .then(datos => {
            console.log(datos);
            
            let auxData = this.setCantidades(datos)
            this.setState((state, props) => {               
                const mesNombre = '';

                if (datos.length != 0) {
                    const mesNombre = datos[0].mes;
                }

                return {
                    vendedoras: datos,
                    mes: mesNombre,
                    objetivo: datos[0].objetivo.cantidad_cursos,
                    arrayCant: auxData
                }
            })
        })
    }

    createData(vendedora){
        
        let arrayCantidades = {credito:0, efectivo:0, efectivoTotal:0, kit:0,uy:0}
        let total = 0;
        vendedora.ventasAlta.map((venta, index) => {
            
            switch (venta.datos_alumno.tipo_pago) {
                case 'credito':
					arrayCantidades.credito++;
					total++;
                    break;    
                case null:
					arrayCantidades.credito++;
					total++;
                    break;  
                case 'efectivoTotal':
					arrayCantidades.efectivoTotal++;
					total++;
                    break;
                case 'efectivo':
                    arrayCantidades.efectivo++;
                    break;                
                default:
                    break;
            }

            if (venta.datos_alumno.kit) {
                arrayCantidades.kit++;
            }
            if (venta.datos_user != null) {
                if (venta.datos_user.country == 'UY') {
                    arrayCantidades.uy++;
                }
            }
            total += venta.puntos_extra;
		});
		
        let ventasTotales = total +arrayCantidades.efectivo ;
		
        return {name: vendedora.name, ventas: arrayCantidades, total: vendedora.puntos, totalVentas:ventasTotales}
    }

    setCantidades(vendedoras){
        let arrayData = new Array();

        if (vendedoras != null) {
            vendedoras.map((vendedora, index1) => {
                if (vendedora.habilitado) {
                    
                    arrayData.push(this.createData(vendedora));
                }
                
            });
            
            this.setState((state) => {
                return{
                    arrayCant: arrayData
                }
            })
            return arrayData;
        }
        return [0,0,0];
    }

	toggleDataSeries(e){
		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		}
		else{
			e.dataSeries.visible = true;
		}
		this.chart.render();
	}
	
	dataColumns(arrayData){

		let data = new Array();

		if (arrayData.length != 0) {
			let indices = Object.getOwnPropertyNames(arrayData[0].ventas);
			
			for (let i = 0; i < indices.length; i++) {
				let dataAux = {
					type: "stackedColumn",
					name: indices[i],
					showInLegend: true,
					yValueFormatString: "#",
					dataPoints: []
				};
				arrayData.map((vendedora) => {
					dataAux.dataPoints.push({ label: vendedora.name+": "+vendedora.total, y: vendedora.ventas[indices[i]]})
				});				
				data.push(dataAux);
			}		
		}

		return data;
    }
    renderComisiones(){
        const comisiones = this.state.arrayCant.map((vendedora) => {
            let comision = 0;
            if (vendedora.total > this.state.objetivo)  {
                comision = ((vendedora.total)-this.state.objetivo)*500;
            }
            return(
                <p><strong>{vendedora.name+'(ventas='+vendedora.totalVentas+')'} : $</strong> {comision} </p>
            );
        });

        return(
            <div className="d-flex mt-2">

                <div className=" alert alert-info">
                    <h4 style={{color:'#751F1F',fontWeight:'bold'}}>Comisiones:</h4>
                    <div>
                    {comisiones}
                    </div>
                </div>
                <div className="alert alert-warning">
                    <h4 style={{fontWeight:'bold'}}>Premio 40 Cursos:</h4>
                    <ul>
                        <li>Mariana : $ 5000</li>
                    </ul>
                </div>
            </div>
        );
    }
    
	render() {

		const dataCant = this.dataColumns(this.state.arrayCant);
		
		const options = {
			animationEnabled: true,
			exportEnabled: true,
			title: {
				text: "Ventas por mes",
				fontFamily: "verdana"
			},
			axisY: {
				title: "Cantidad",
				prefix: "",
				suffix: ""
			},
			toolTip: {
				shared: true,
				reversed: true
			},
			legend: {
				verticalAlign: "center",
				horizontalAlign: "right",
				reversed: true,
				cursor: "pointer",
				itemclick: this.toggleDataSeries
			},
			data: dataCant,
        }
        let select = <SelectMeses valueMes={this.handleChangeMes} />;
        if (this.state.mesView != null) {
            select = null;
        }
        
        if (this.state.arrayCant.length != 0) {
            
            return (
                <div>
                    {select}
                    <CanvasJSChart options = {options}
                        onRef={ref => this.chart = ref}
                        />
                    {this.renderComisiones()}
                </div>
		    );
        }
        return <h1>Searching data...<CircularProgress /> </h1>
	}
}
 
if (document.getElementById('grafico_comisiones_mes')) {
    ReactDOM.render(
        <LiquidacionMes mesView={1} />,
        document.getElementById('grafico_comisiones_mes')
    );   
}