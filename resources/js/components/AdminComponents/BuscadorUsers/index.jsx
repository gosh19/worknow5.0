import React from 'react';
import ReactDOM from 'react-dom';

import TablaUsers from './BuscadorAlumnos.jsx';



class Principal extends React.Component {
  constructor() {
    super();

  }

  render(){
    return(
      <div className="container">
        <div className="card mb-3">
          <div className="card-header mb-3">
            Buscador
          </div>
          <TablaUsers />
          
        </div>
      </div>
    );
  }
}


if (document.getElementById('appCobro')) {
  ReactDOM.render(
    <Principal />,
    document.getElementById('appCobro')
  );
}
