import React, {Component}  from 'react';
import Button from '../button/Button';
import propTypes from 'prop-types';
import Message from '../message/Message';
import GoodsList from '../list/goods/GoodsList';

class GoodPage extends Component {
    render() {
        return (
            <div>
                <Message text={this.props.message}/>
            <div>
                {this.props.showGenerateButton &&
                <Button onClick={this.props.onClickGenerateGoods} caption={'Сгенерировать товары'}/>}

                {this.props.showGoods &&
                    <Button onClick={this.props.onClickShowGoods} caption={'Показать товары'}/>
                }

                {this.props.showCreateOrder &&
                    <Button onClick={this.props.onCreateOrder} caption={'Создать заказ'}/>
                }

                {this.props.showPayOrder &&
                    <div>
                        Оплатить на сумму: &nbsp;<input type={'number'} onChange={this.props.onChangePaySum} />
                        <Button onClick={this.props.onPayOrder} caption={'Оплатить'}/>
                    </div>
                }
            </div>
                <div>
                    <GoodsList
                        goods={this.props.goods}
                        onCheckItem={this.props.onCheckGood}
                    />
                </div>
                {this.props.sum > 0 &&
                    <div>Сумма заказа: {this.props.sum}</div>
                }
            </div>
        );
    }
}

GoodPage.propTypes = {
    showGenerateButton: propTypes.bool.isRequired,
    onClickGenerateGoods: propTypes.func.isRequired,
    showGoods: propTypes.bool.isRequired,
    onClickShowGoods: propTypes.func.isRequired,
    onCreateOrder: propTypes.func.isRequired,
    showCreateOrder: propTypes.bool.isRequired,
    message: propTypes.string.isRequired,
    showPayOrder: propTypes.bool.isRequired,
    onPayOrder: propTypes.func.isRequired,
    goods: propTypes.array.isRequired,
    onCheckGood: propTypes.func.isRequired,
    sum: propTypes.number.isRequired,
    selectedGoodsIds: propTypes.array.isRequired,
    onChangePaySum: propTypes.func.isRequired
};

export default GoodPage;