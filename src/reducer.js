import {combineReducers} from 'redux';
import goodsReducer from './module/goods/reducer';

export default combineReducers({
    goods: goodsReducer
});