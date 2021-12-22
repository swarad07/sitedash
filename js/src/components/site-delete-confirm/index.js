import React from 'react';
import './site-delete-confirm.css';
import axios from "axios";

const SiteDeleteConfirm = ({ id, closeModalCallback, closeDeleteSiteModal }) => {
  const deleteSiteCallback = (e) => {
    e.preventDefault();
    const sitedash = {
      'id': id,
    };

    axios.delete('/sitedash/api/v1/operations', { data: sitedash })
    .then(response => console.log('site deleted'));

    closeDeleteSiteModal();
    closeModalCallback();
    window.location.reload();
  };

  return (
    <div className="site-delete-form">
      <div className="form-elements">
        <div className="site-dash--form-title">
          Are you sure you want to DELETE this site, this action cannot be Undone?
        </div>
      </div>
      <div className="actions">
        <button className="site-tile-btn tertiary" onClick={(e) => deleteSiteCallback(e)} type="submit">I Confirm, Delete this Site</button>
        <button className="site-tile-btn secondary" onClick={() => closeDeleteSiteModal() }>Cancel</button>
      </div>
    </div>
  )
};

export default SiteDeleteConfirm;
