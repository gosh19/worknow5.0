import React, { Component } from 'react'
import { TextField, Button } from '@mui/material';

import swal from 'sweetalert';

export default class FormConsultaFaq extends Component {
    constructor(props){
        super(props);
        this.state= {
            consulta:'',
        }

        this.handleInputChange = this.handleInputChange.bind(this);
        this.sendConsulta = this.sendConsulta.bind(this);
    }

    handleInputChange(e){  
        const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;
        this.setState((state, props) => ({
            [name]: value
        }));

    }

    sendConsulta(){

        const data ={
            'consulta': this.state.consulta,
        }
        if (this.state.consulta != '') {
            
        
            fetch('load-consulta',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                credentials: "same-origin",
                body: JSON.stringify(data)
            })
            .then((response) => response.json())
            .then((info) => {
                if (info.estado) {
                    swal("Good job!", "Tu consulta ha sido enviada con exito, y sera revisada a la brevedad!", "success");
                    this.setState((state, props) => ({
                        consulta: ''
                    }));
                }else{
                    swal(":(", "Error con el servidor", "error");
                }
                
            })
            .catch((e) => console.log('NO HAY ONDA'+e));
        
        
        }
    }


    render() {
        
        return (
            <div style={{
                            padding: '30px',
                            marginTop: '20px'
                        }}
            >
                <TextField
                    id="standard-multiline-static"
                    label="¿Quiere dejar una nueva consulta?"
                    multiline
                    fullWidth
                    name="consulta"
                    rows="4"
                    value={this.state.consulta}
                    onChange={this.handleInputChange}
                />
                <Button 
                    variant="contained"
                    color="primary"
                    className="mt-3"
                    onClick={this.sendConsulta}
                >
                    Enviar consulta
                </Button>
            </div>
        )
    }
}
