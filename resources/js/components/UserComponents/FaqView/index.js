import React, { Component } from 'react'
import ReactDOM from 'react-dom';

import ControlledExpansionPanels from './ControlledExpansionPanels';
import FormConsultaFaq from './FormConsultaFaq';

class FaqView extends Component {
    render() {
        return (
            <div>
                <ControlledExpansionPanels />
                <FormConsultaFaq />
            </div>
        )
    }
}

if (document.getElementById('faq-page')) {

    ReactDOM.render(
      <FaqView />,
      document.getElementById('faq-page')
    );
  
  }