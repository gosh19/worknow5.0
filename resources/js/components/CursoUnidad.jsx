import React from 'react';
import ReactDOM from 'react-dom';

class Main extends React.Component {
  constructor() {
    super();
    this.state = {
      cursos: "",
    }

  }

  componentDidMount(){
    var aux;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('usuarios').innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "/test.php", false);
    xmlhttp.send();
    this.setState(state =>({
      cursos: aux,
    }));
  }

  renderCosas(){
  //  var e = document.getElementById('a0').value();
    return this.state.cursos;

  }

  render(){
    return (
      <div className="card">
        <div className="card-header">
          Cursos
        </div>
        <ul className="list-group list-group-flush">
          {this.renderCosas()}
        </ul>
        <button className="btn btn-primary" onClick={this.mostrar}>Mostrar</button>

      </div>
    );
  }
}


if (document.getElementById('usuariaos')) {
  ReactDOM.render(
    <Main />,
    document.getElementById('usuariaos')
  );
}
