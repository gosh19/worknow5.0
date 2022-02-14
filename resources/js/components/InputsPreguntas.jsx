import React from 'react';
import ReactDOM from 'react-dom';

class Inputs extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      name:"question["+this.props.cantidad+"]",
      nameans0: "answer["+this.props.cantidad+"][0]",
      nameans1: "answer["+this.props.cantidad+"][1]",
      nameans2: "answer["+this.props.cantidad+"][2]",
      correcta: "correcta["+this.props.cantidad+"]",
    }
  }

  render(){
    return(
      <div className="card mt-3">
        <div className="card-header">
          <div className="input-group mb-1 mt-1">
            <input type="text" className="form-control" name={this.state.name} placeholder="Pregunta..."/>
          </div>
        </div>


        <div className="input-group mb-3">
          <div className="input-group-prepend">
            <div className="input-group-text">
            <input type="radio" name={this.state.correcta} value="1"/>
            </div>
          </div>
          <input type="text" className="form-control" name={this.state.nameans0} placeholder="Respuesta 1..." />
        </div>

        <div className="input-group mb-3">
          <div className="input-group-prepend">
            <div className="input-group-text">
            <input type="radio" name={this.state.correcta} value="2"/>
            </div>
          </div>
          <input type="text" className="form-control" name={this.state.nameans1} placeholder="Respuesta 2..."/>
        </div>

        <div className="input-group mb-3">
          <div className="input-group-prepend">
            <div className="input-group-text">
            <input type="radio" name={this.state.correcta} value="3"/>
            </div>
          </div>
          <input type="text" className="form-control" name={this.state.nameans2} placeholder="Respuesta 3..."/>
        </div>
      </div>
    );
  }
}

class Formulario extends React.Component {
  constructor() {
    super();
    this.state ={
      cantidad: 1,
    }
    this.cargar = this.cargar.bind(this);
    this.Agregar = this.Agregar.bind(this);
  }

  cargar(){
    let file = [];
    for (var i = 0; i < this.state.cantidad; i++) {
      file[i] = <Inputs
                  key={i}
                  cantidad={i}/>
    }
    return file;
  }

  Agregar(e){
    e.preventDefault();
    this.setState(state =>({
      cantidad: this.state.cantidad+1,
    }))
  }
  render(){
    return(
      <div>
        {this.cargar()}
        <button className="btn btn-danger" onClick={this.Agregar}>Agregar Otra Pregunta</button>
      </div>
    );
  }
}

if (document.getElementById('form-preguntas')) {
  ReactDOM.render(
    <Formulario />,
    document.getElementById('form-preguntas')
  );
}
