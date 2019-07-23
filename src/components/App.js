import React, { Component } from "react";
import '../styles/App.css';
import { Provider } from 'react-redux';
import mainStore from '../mainStore';
import ConnectedGoodsPage from "../module/goods/ConnectedGoodsPage";

class App extends Component {
    render() {
        return (
            <Provider store={mainStore}>
            <div>
            <h1>Тестовое React-приложение для VseIns</h1>
                <br/>
                <ConnectedGoodsPage />
        </div>
            </Provider>
    );
    }
}

export default App;