import React from 'react';
import './textfield.css';

const TextField = ({placeholder, name, description, required, defaultValue}) => {
  return (
    <div className={`site-dash--form-item-wrapper wrapper-${name}`}>
      <input
        type="text"
        name={name}
        id={`site-dash-field-${name}`}
        placeholder={placeholder}
        className={`site-dash--texfield site-dash-field-${name}`}
        required={required !== false}
        defaultValue={defaultValue !== undefined  ? defaultValue : ""}
      />
      <div className={`site-dash--desc`}>{description}</div>
    </div>
  );
};

export default TextField;
