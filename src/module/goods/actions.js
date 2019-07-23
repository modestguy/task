import {fetchApi} from "../../common/net/api/Api";

export const initState = {
    showGenerateButton: true,
    showGoods: false,
    showCreateOrder: false,
    showPayOrder: false,
    goods: [],
    message: '',
    selectedGoodsIds: [],
    sum: 0,
    paySum: 0,
    orderId: null
};

export const CLICK_GENERATE_GOODS = '/module/goods/CLICK_GENERATE_MODULE';
export const showLoadGoodsButton = (message, showGoods) => ({
  type: CLICK_GENERATE_GOODS,
  payload: {
        message,
        showGoods,
        showCreateOrder: true
    }
});

export const SHOW_GOODS = '/module/goods/SHOW_GOODS';
export const showGoodsList = (goods, message) => ({
   type: SHOW_GOODS,
   payload: {
       goods,
       message
   }
});

export const CHANGE_SELECTED_GOODS = '/module/goods/CHANGE_SELECTED_GOODS';
export const changeSelectedGoods = (selectedGoodsIds, sum) => ({
   type: CHANGE_SELECTED_GOODS,
   payload: {
       selectedGoodsIds,
       sum
   }
});

export const CHANGE_PAY_SUM = '/module/goods/CHANGE_PAY_SUM';
export const changePaySum = (sum) => ({
   type: CHANGE_PAY_SUM,
   payload: {
       paySum: sum
   }
});

export const CREATE_ORDER = '/module/goods/CREATE_ORDER';
export const createOrder = (orderId) => ({
   type: CREATE_ORDER,
   payload: {
       orderId,
       showGenerateButton: false,
       showGoods: false,
       showPayOrder: true,
       showCreateOrder: false,
       goods: [],
       message: ''
   }
});

export const ERROR_MESSAGE = '/module/goods/ERROR_MESSAGE';
export const errorMessage = (message) => ({
   type: ERROR_MESSAGE,
   payload: {
       message
   }
});

export const pushOrPopGood = (id, price) => (dispatch, getState) => {
      let data = getState().goods;
      let selectedIds = data.selectedGoodsIds;
      let sum = data.sum;
      const index = selectedIds.indexOf(id);
      if (index !== -1) {
          sum -= price;
          selectedIds.splice(index, 1);
      } else {
          sum += price;
          selectedIds.push(id);
      }
      dispatch(changeSelectedGoods(selectedIds, sum));
};

export const showGoods = () => dispatch => {
    fetchApi('GET', '/api/goods', null, null, function (result){
        dispatch(showGoodsList(result.items, ''));
    }, function (result) {
        console.log(result);
    });
};

export const clickGenerateGoods = () => dispatch => {
    fetchApi('POST', '/api/goods/fill', null, null, function (result) {
        dispatch(showLoadGoodsButton(result.success, true));
    }, function (result) {
        dispatch(showLoadGoodsButton(result.error, false));
    });
};


export const createPayOrder = () => (dispatch, getState) => {
  fetchApi('POST', '/api/order/create', {'goods' : getState().goods.selectedGoodsIds}, null,
      function (result) {
            if (result.id)
                dispatch(createOrder(result.id));

            if (result.error)
                dispatch(errorMessage(result.error));
      })
};


export const payOrder = () => (dispatch, getState) => {
  const data = getState().goods;
  fetchApi('POST', '/api/order/pay', {'id': data.orderId, 'sum' : data.paySum}, null, function(result) {
      if (result.success)
            dispatch(errorMessage(result.success));

      if (result.error)
          dispatch(errorMessage(result.error));

  });
};