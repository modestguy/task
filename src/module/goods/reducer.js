import * as Actions from './actions';

export const reducer = (state = Actions.initState, action) => {
    switch (action.type) {
        case Actions.CLICK_GENERATE_GOODS:
        case Actions.SHOW_GOODS:
        case Actions.CHANGE_SELECTED_GOODS:
        case Actions.CREATE_ORDER:
        case Actions.CHANGE_PAY_SUM:
        case Actions.ERROR_MESSAGE:
            return {...state, ...action.payload};
        default:
            return state;
    }
};

export default reducer;