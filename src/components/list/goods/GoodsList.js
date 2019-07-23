import React, {Component} from 'react';
import propTypes from 'prop-types';
import GoodListItem from "./GoodListItem";

class GoodsList extends Component {
    render () {
        return (
            <ul>
                {this.props.goods.map(good => (
                    <GoodListItem key={good.id}
                        id={good.id}
                        name={good.name}
                        price={good.price}
                        selected={false}
                        onCheck={this.props.onCheckItem}
                    />
                    )
                )}
            </ul>
        );
    }
}

GoodsList.propTypes = {
    goods: propTypes.array.isRequired,
    onCheckItem: propTypes.func.isRequired
};

export default GoodsList;