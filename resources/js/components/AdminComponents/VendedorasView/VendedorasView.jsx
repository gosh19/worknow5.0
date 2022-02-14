import  React  from 'react';
import { Grid } from '@mui/material';
import CardVendedora from './CardVendedora';



export default class VendedorasView extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            vendedoras: [],
            ventasPorDia: [],
        }
        this.setVendedoras = this.setVendedoras.bind(this)
    }
    componentDidMount(){
        
        this.setVendedoras();
    }
    
    setVendedoras(){
        fetch('/get-ventas-por-dia')
        .then(response => response.json())
        .then(datos => {
            
            this.setState({ventasPorDia: datos});
        });

        fetch('/get-vendedoras')
        .then(response => response.json())
        .then(datos => {
            this.setState((state, props) => {               
                
                return {
                    vendedoras: datos,
                }
            })
        });

        

    }

    render() {
        let renderVendedoras = this.state.vendedoras.map((vendedora, index) => {

            const aux = this.state.ventasPorDia.find(ven => {return ven.name == vendedora.name });
            
            vendedora.rendimiento = aux.rendimiento;
            if (vendedora.ventasAlta != 0) {
                
                return <Grid
                            item
                            key={vendedora.id}
                        >

                        <CardVendedora 
                            key={vendedora.id}
                            index={index}
                            letter={vendedora.name.charAt(0)}
                            vendedora={vendedora}
                            ventasAlta = {vendedora.ventasAlta}
                            ventasBaja = {vendedora.ventasBaja}
                            objetivo={vendedora.objetivo}
                            />
                    </Grid>
            }
        })
        return (
            <div>
                <Grid
                    container
                    direction="row"
                    justify="center"
                    alignItems="flex-start"
                    spacing={3}
                    style={{width: "100%", marginTop:25}}
                >
                {renderVendedoras}
                </Grid>
                
            </div>
        )
    }
}