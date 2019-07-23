import {createStore, applyMiddleware} from 'redux';
import thunk from 'redux-thunk';
import reducer from './reducer';

let middleware = applyMiddleware(thunk);
const mainStore = createStore(reducer, middleware);

export default mainStore;