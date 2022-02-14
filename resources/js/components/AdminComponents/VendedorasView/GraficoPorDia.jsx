/* App.js */
import React, { Component } from 'react';
import CanvasJSReact from './../../../canvasJs/canvasjs.react';
import SelectMeses from './SelectMeses';

var CanvasJSChart = CanvasJSReact.CanvasJSChart;

class GraficoPorDia extends Component {
    constructor(props){
        super(props);
        this.state = {
            ventas: [],
            mes:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            indexMonth: 0,
        }
        this.getVentas = this.getVentas.bind(this);
        this.handleChangeMes = this.handleChangeMes.bind(this);
    }

    getVentas(mes = null){
        let url = '/get-ventas-por-dia';
        if (mes != null) {
           url = '/get-ventas-por-dia/'+mes;
        }
        this.setState((state, props) =>{
            return {
                ventas: [],
            }
        })
        fetch(url)
        .then(response => response.json())
        .then(info => {

                console.log(info);
                info.map((vendedora, index) => {
                    let dataAux = {
                        type: "spline",
                        name: vendedora.name+' - '+vendedora.rendimiento,
                        showInLegend: true,
                        dataPoints: null,
                    }

                    let arrayDataPoints = [];
                    vendedora.VentasPorDia.map((venta, index) =>{
                        arrayDataPoints.push({y:venta.cant, label:venta.dia });
                    });

                    dataAux.dataPoints = arrayDataPoints;

                    this.setState((state, props) =>{
                        let aux = state.ventas;
                        aux.push(dataAux);
                        return {
                            ventas: aux,
                        }
                    })
                })
            
        })
    }
    handleChangeMes(valueMes){        

        this.getVentas(valueMes);
        this.setState({indexMonth: (valueMes-1)});
    }

    componentDidMount(){
        let date = new Date();

        this.setState({indexMonth: (date.getMonth())});
        this.getVentas();
    }

	render() {
        console.log(this.state.ventas);
        
		const options = {
				animationEnabled: true,	
				title:{
					text: "Grafico de Ventas de "+this.state.mes[this.state.indexMonth],
				},
				axisY : {
					title: "Cantidad de ventas",
					includeZero: false
                },
                axisX : {
					title: "Dia Numero",
					includeZero: false
				},
				toolTip: {
					shared: true
				},
				data: this.state.ventas,
		}
		return (
		<div>
            <SelectMeses valueMes={this.handleChangeMes} />
			<CanvasJSChart options = {options}
				/* onRef={ref => this.chart = ref} */
			/>
			{/*You can get reference to the chart instance as shown above using onRef. This allows you to access all chart properties and methods*/}
		</div>
		);
	}
}
export default GraficoPorDia;                       