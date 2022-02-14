import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import { Button } from '@mui/material';

class FaqBox extends Component {
    render() {
        return (
            <div>
                <Button 
                    color="secondary"
                    className="mb-5"
                    fullWidth={true}
                    href="/faq-view"
                    variant="contained"
                    style={{fontWeight:'bold'}}
                >Preguntas frecuentes</Button>
            </div>
        )
    }
}


if (document.getElementById('faq-box')) {

    ReactDOM.render(
      <FaqBox />,
      document.getElementById('faq-box')
    );
  
  }
  
