import React, { Component } from 'react'

import {Grid } from '@mui/material';

export default class EntregaTp extends Component {
    render() {
        return (
            <div style={{padding: '40px', border: '2px solid grey', borderRadius: '20px'}} >
                <Grid 
                    container
                    direction="row"
                >
                    <Grid
                        item
                        md={6}
                    >
                        <h1>Paso 1:</h1>
                        <img className="img-responsive" src="img-tutoriales/entrega-tp-paso-1.jpg" />
                    </Grid>
                    <Grid
                        item
                        md={6}
                    >
                        <h1>Paso 2:</h1>
                        <img className="img-responsive" src="img-tutoriales/entrega-tp-paso-2.jpg" />
                    </Grid>
                </Grid>
                <hr />
                <Grid 
                    container
                    direction="row"
                >
                    <Grid
                        item
                        md={6}
                    >
                        <h1>Paso 3:</h1>
                        <img className="img-responsive" src="img-tutoriales/entrega-tp-paso-3.jpg" />
                    </Grid>
                    <Grid
                        item
                        md={6}
                    >
                        <h1>Paso 4:</h1>
                        <img className="img-responsive" src="img-tutoriales/entrega-tp-paso-4.jpg" />
                    </Grid>
                </Grid>
            </div>
        )
    }
}
