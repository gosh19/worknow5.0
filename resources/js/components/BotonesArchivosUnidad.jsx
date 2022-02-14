import React from 'react';
import ReactDOM from 'react-dom';

function Inputs(props) {
  var files =[];
  var nombre = props.nombre+"[";
  var nombreaux;
  var nombremodulo;
  var agregarnombre;


  for (var i = 0; i < props.cantidad; i++) {
    nombreaux = nombre + i +"]";
    nombremodulo = "titulo"+nombre + i +"]";
    if (props.nombre== "modulos") {
      agregarnombre=
      <div>
        <div className="input-group-prepend">
          <span className="input-group-text" id="basic-addon3">Nombre:</span>
        </div>
        <input type="text" name={nombremodulo} className="form-control" id="basic-url" aria-describedby="basic-addon3" required />
      </div>
    }


    files[i] =
    <div key={i}>
      {agregarnombre}
      <div className="input-group">
        <div className="input-group mb-3">
          <div className="custom-file">
            <input  type="file" name={nombreaux} className="custom-file-input " id="inputGroupFile02" required/>
            <input id="input" className="custom-file-label" for="inputGroupFile02" placeholder="Elegir Archivo" />
          </div>
        </div>
      </div>
    </div>
  }
  return(
    <div>{files}</div>
  )
}

class Archivos extends React.Component{
  constructor(props) {
    super(props)
    this.Agregar = this.Agregar.bind(this);
    this.Quitar = this.Quitar.bind(this);
    this.state ={
      cantidad: 1,
    }
  }

  Agregar(e){
    e.preventDefault();
    this.setState(state => ({
      cantidad: this.state.cantidad + 1,
    }));
  }

  Quitar(e){
    e.preventDefault();
    if (this.state.cantidad != 1) {
      this.setState(state => ({
        cantidad: this.state.cantidad - 1,
      }));
    }
    else {
      alert("Debes agregar al menos un archivo!");
    }
  }
  render(){
    return(
      <div className="row">
        <div className="col">
          <Inputs
            cantidad={this.state.cantidad}
            nombre={this.props.nombre}
            />
        </div>
        <div className="col">
          <div className="input-group mb-2 justify-content-center">
            <button className="btn btn-primary" onClick={this.Agregar}>Agregar Mas {this.props.nombre}</button>
          </div>
          <div className="input-group mb-2 justify-content-center">
            <button className="btn btn-primary" onClick={this.Quitar}>Eliminar el ultimo cargado</button>
          </div>
        </div>
      </div>
    )
  }
}

if (document.getElementById('TpsUnidad')) {
  ReactDOM.render(
    <Archivos
      nombre ="tps"
      />,
    document.getElementById('TpsUnidad')
  );
}

if (document.getElementById('ModulosUnidad')) {
  ReactDOM.render(
    <Archivos
      nombre ="modulos"
      />,
    document.getElementById('ModulosUnidad')
  );
}
