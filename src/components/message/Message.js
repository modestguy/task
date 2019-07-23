import React, {Component} from 'react';
import propTypes from 'prop-types';
import './Message.css';

class Message extends Component {
    render() {
        return (
            <div className='message'>{this.props.text}</div>
        );
    }
}

Message.propTypes = {
    text: propTypes.string.isRequired
};

export default Message;


