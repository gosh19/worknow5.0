import React from 'react';
import { CircularProgress, Checkbox } from '@mui/material';


/**
 * BUSCADOR DE ALUMNOS
 */
class TablaUsers extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      estados: [],
      search: 0,
    }
    this.updateSearch = this.updateSearch.bind(this);
    this.renderTable = this.renderTable.bind(this);
    this.handleChange = this.handleChange.bind(this);

  }

  updateSearch(event){

    var id = event.target.value;

    if ((event.target.value == "")) {

      this.setState({ estados: [{id:'---', name: '---', email: '---', url: '#'}]});
    }
    else {
      this.setState({ estados: [{id:<CircularProgress />, name: <CircularProgress />, email: <CircularProgress />, telefono: <CircularProgress /> , url: '#'}]});
      var url = '/mostrarAlumno/'+id+'/'+this.state.search;
      
      fetch(url)
      .then(response => response.json())
      .then(info =>{
        
        this.setState((state, props) => {
            return {
              estados: info,
                  } 
            });
      })
      .catch(function (error) {
        console.log(error);
      });

    }
  }

  handleChange(){
    this.setState(prevState =>  {
      if (prevState.search == 0) {
        
        return {
          estados: [],
          search: 1,
        }
      }
      return {
        search: 0,
      }
    }
      );
  }

  renderTable(data){
    
    let users = null;
    if (this.state.search) {
      
      
      users = data.map((datosUser, index) => {
        let user = datosUser.user;
        let urlVeralumno = '/modificarAlumno/?id=';

        if (user != null) {
          
            if (user.id == "---") {
              urlVeralumno = '#'
            }
          return  <tr key={index}>
                    <td> {user.id} </td>
                    <td> {user.name} </td>
                    <td> {user.email} </td>
                    <td> {datosUser.telefono}</td>
                    <td><a className="btn btn-danger btn-block" href={urlVeralumno+user.id}>Ver</a></td>
                  </tr>
        }
      }
      );
    }else{
      users = data.map((user, index) => {
        
        let urlVeralumno = '/modificarAlumno/?id=';
        if (user.id == "---") {
          urlVeralumno = '#'
        }
        if (user.telefono == undefined) {
          if (user.datos_user == null) {
            user.telefono = "sin cargar";
            
          }else{
            user.telefono = user.datos_user.telefono;
          }
          
        }
        return <tr key={index}>
            <td> {user.id} </td>
            <td> {user.name} </td>
            <td> {user.email}</td>
            <td> {user.telefono}</td>
            <td><a className="btn btn-danger btn-block" href={urlVeralumno+user.id}>Ver</a></td>
          </tr>
      }
      );
    }

  return  <table className="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">E-mail</th>
                <th scope="col">Telefono</th>
                <th scope="col">---</th>
              </tr>
            </thead>
            <tbody>
              {users}
            </tbody>
          </table>;

}


  componentDidMount(){
    const  users = <tr>
      <th scope="col">------</th>
      <th scope="col">------</th>
      <th scope="col">------</th>
      <th scope="col">------</th>
    </tr>;
  }

  render() {
    
    
    return (
      <div>
        <input 
          id="buscador" 
          type="text" 
          id="buscador" 
          placeholder="Recuerda que puedes buscar por mail nombre o numero de alumno" 
          className="form-control mb-3" 
          onChange={this.updateSearch}
        />
        <hr/>
        <Checkbox checked={this.state.search} onChange={() => this.handleChange()}/>
        por telefono
        {this.renderTable(this.state.estados)}
      </div>
    );
  }
}

export default TablaUsers;
