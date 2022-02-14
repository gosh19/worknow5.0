import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import { Slide } from '@mui/material';


import { makeStyles } from '@mui/material/styles';
import Paper from '@mui/material/Paper';
import Tabs from '@mui/material/Tabs';
import Tab from '@mui/material/Tab';
import BarChartIcon from '@mui/icons-material/BarChart';
import TimelineIcon from '@mui/icons-material/Timeline';
import AssignmentIndIcon from '@mui/icons-material/AssignmentInd';
import VendedorasView from './VendedorasView';
import Graficos from './Graficos';
import LiquidacionMes from './LiquidacionMes';
import GraficoPorDia from './GraficoPorDia';

const useStyles = makeStyles({
    root: {
      flexGrow: 1,
    },
  });
  
  export default function IconTabs() {
    const classes = useStyles();
    const [value, setValue] = React.useState(0);
  
    const handleChange = (event, newValue) => {
      setValue(newValue);
    };
  
    return (
      <Paper square className={classes.root}>
        <Tabs
          value={value}
          onChange={handleChange}
          variant="fullWidth"
          indicatorColor="primary"
          textColor="primary"
          aria-label="icon tabs example"
        >
          <Tab icon={<AssignmentIndIcon />} aria-label="sellers" />
          <Tab icon={<BarChartIcon />} aria-label="graph" />
          <Tab icon={<BarChartIcon />} aria-label="liqui" />
          <Tab icon={<TimelineIcon />} aria-label="by-day" />
        </Tabs>
        <Content key={value} value={value} />
      </Paper>
    );
  }

class Content extends Component {
    constructor(props){
        super(props);
        this.state = {
            value: this.props.value,
            content: null,
        }
    }

    
    componentDidMount(){ 
               
        switch (this.state.value) {
            case 0:
                
                this.setState((state, props) => {
                    return{
                        content: <VendedorasView />
                    }
                });
                
                break;
            case 1:
            
                this.setState((state, props) => {
                    return{
                        content: <Graficos />
                    }
                });
                
                break;
            case 2:
        
                this.setState((state, props) => {
                    return{
                        content: <LiquidacionMes />
                    }
                });
                
                break;
            case 3:
    
                this.setState((state, props) => {
                    return{
                        content: <GraficoPorDia />
                    }
                });
                
                break;
            default:
                this.setState((state, props) => {
                    return{
                        content: 'null',
                    }
                });
                break;
        }
    }
    
    render(){

        return (
            <Slide direction="left" in={true} mountOnEnter unmountOnExit>
                <Paper>
                    <div>

                        {this.state.content}
                    </div>
                </Paper>
            </Slide>
        )
    }
}




if (document.getElementById('VendedorasView')) {
    ReactDOM.render(
        <IconTabs />,
        document.getElementById('VendedorasView')
    );
    
}