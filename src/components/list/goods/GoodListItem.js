import React, {Component} from 'react';
import propTypes from 'prop-types';

class GoodListItem extends Component {
    render() {
        return (
            <li key={this.props.id}>
                {this.props.name} {this.props.price} руб.
                <input type={'checkbox'} selected={this.props.selected} onClick={() => this.props.onCheck(this.props.id, this.props.price)}/>
            </li>
        );
    }
}

GoodListItem.propTypes  = {
    id: propTypes.number.isRequired,
    name: propTypes.string.isRequired,
    price: propTypes.number.isRequired,
    selected: propTypes.bool.isRequired,
    onCheck: propTypes.func.isRequired
};

export default GoodListItem;