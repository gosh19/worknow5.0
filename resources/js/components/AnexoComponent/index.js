import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Grid } from '@mui/material';

import CrearAnexo from './CrearAnexo';

class Anexoindex extends Component {
    render() {
        return (
            <div>
                <Grid
                    container
                    justify="center"
                    alignContent="center"
                    alignItems="center"
                >
                    <Grid item>
                        <CrearAnexo />
                    </Grid>
                    asdasd
                </Grid>
            </div>
        );
    }
}

if (document.getElementById('anexos-view')) {
    ReactDOM.render(
        <Anexoindex />,
        document.getElementById('anexos-view')
    );
}