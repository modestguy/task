import React, {Component} from 'react';
import propTypes from 'prop-types';
import button from './Button.css';

class Button extends Component {
    render () {
        return (
            <button onClick={this.props.onClick}>{this.props.caption}</button>
        );
    }
}

Button.propTypes = {
    onClick: propTypes.func.isRequired,
    caption: propTypes.string.isRequired
};

export default Button;