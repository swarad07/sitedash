import React from 'react';
import './site-delete-confirm.css';

const SiteDeleteConfirm = ({ closeModalCallback }) => {
  return (
    <div className="site-delete-form">
      <div className="form-elements">
        <div className="site-dash--form-title">
          Are you sure you want to DELETE this site, this action cannot be Undone?
        </div>
      </div>
      <div className="actions">
        <button className="site-tile-btn tertiary" type="submit">I Confirm, Delete this Site</button>
        <button className="site-tile-btn secondary" onClick={() => closeModalCallback() }>Cancel</button>
      </div>
    </div>
  )
};

export default SiteDeleteConfirm;
