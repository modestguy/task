import GoodPage from '../../components/pages/GoodPage';
import {connect} from 'react-redux';
import * as Actions from './actions';

const mapDispatchToProps = (dispatch) => ({
    onClickGenerateGoods: () => dispatch(Actions.clickGenerateGoods()),
    onClickShowGoods: () => dispatch(Actions.showGoods()),
    onCreateOrder: () => dispatch(Actions.createPayOrder()),
    onChangePaySum: (event) => dispatch(Actions.changePaySum(event.target.value)),
    onPayOrder: () => dispatch(Actions.payOrder()),
    onCheckGood: (id, price) => dispatch(Actions.pushOrPopGood(id, price))
});

const mapStateToProps = state => ({
    showGenerateButton: state.goods.showGenerateButton,
    showGoods: state.goods.showGoods,
    showCreateOrder: state.goods.showCreateOrder,
    message: state.goods.message,
    showPayOrder: state.goods.showPayOrder,
    goods: state.goods.goods,
    sum: state.goods.sum,
    selectedGoodsIds: state.goods.selectedGoodsIds
});

const ConnectedGoodsPage = connect(mapStateToProps, mapDispatchToProps)(GoodPage);
export default ConnectedGoodsPage;