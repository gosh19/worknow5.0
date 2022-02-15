import React from 'react';
import ReactDOM from 'react-dom';
import { makeStyles } from '@mui/styles';
import Paper from '@mui/material/Paper';
import Tabs from '@mui/material/Tabs';
import Tab from '@mui/material/Tab';
import HistoryIcon from '@mui/icons-material/History';
import EventIcon from '@mui/icons-material/Event';

import CobrosMes from './CobrosMes';
import HistorialCobros from './HistorialCobros';
import LibroDiario from './LibroDiario';


const useStyles = makeStyles({
  root: {
    flexGrow: 1,
  },
  content:{
    width: '100%',
  }
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
        <Tab icon={<EventIcon />} aria-label="now" />
        <Tab icon={<HistoryIcon />} aria-label="history" />
      </Tabs>
      <Content className={classes.content} key={value} id={value} mountOnEnter/>
    </Paper>
  );
}

class Content extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            content: this.selectContent(props.id)
        }
        this.selectContent = this.selectContent.bind(this);
        this.selectContent(props.id);
    }

    selectContent(value){        
        switch (value) {
            case 0:
                return (<CobrosMes />);
            case 1:
                return (<HistorialCobros />);
            case 2:
                return (<LibroDiario />);
            default:
                break;
        }
    }
    render(){
        return <div>{this.state.content}</div>
    }
}


if(document.getElementById('app-cobranza')){
    ReactDOM.render(
        <IconTabs />,
        document.getElementById('app-cobranza')
    );
}