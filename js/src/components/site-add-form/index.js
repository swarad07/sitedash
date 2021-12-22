import React, { useState } from 'react';
import TextField from '../textfield';
import Popup from 'reactjs-popup';
import SiteDeleteConfirm from '../site-delete-confirm';
import axios from 'axios';

const SiteAddForm = ({ closeModalCallback, id, name, faviconUrl, url, endpoint, token }) => {
  const [deleteSiteOpen, setDeleteSiteModalOpen] = useState(false);
  const closeDeleteSiteModal = () => setDeleteSiteModalOpen(false);

  const saveNewSite = (e) => {
    e.preventDefault();
    if (id === undefined || id === null) {
      const sitedash = {
        'name': document.getElementById('site-dash-field-site-name').value,
        'url': document.getElementById('site-dash-field-site-url').value,
        'faviconUrl': document.getElementById('site-dash-field-site-favicon-url').value,
        'endpoint': document.getElementById('site-dash-field-site-endpoint-url').value,
        'token': document.getElementById('site-dash-field-site-token').value,
      };
      axios.post('/sitedash/api/v1/operations', sitedash)
      .then(response => {
        if (response.entity_saved_flag === 1) {
          // Success.
          console.log('Entity saved successfully!');
        } else {
          // Display error.
        }
      });
      closeModalCallback();
      window.location.reload();
    }
  };

  return (
    <div className="site-add-form">
      <div className="form-elements">
        <TextField
          name="site-name"
          description="The Site Name."
          placeholder="Site Name"
          defaultValue={name}
        />
        <TextField
          name="site-url"
          description="The Site URL."
          placeholder="Site URL"
          defaultValue={url}
        />
        <TextField
          name="site-endpoint-url"
          description="The Site API Endpoint URL."
          placeholder="API Endpoint"
          defaultValue={endpoint}
        />
        <TextField
          name="site-token"
          description="The Site API Token."
          placeholder="API Token"
          defaultValue={token}
        />
        <TextField
          name="site-favicon-url"
          description="The Site faviconURL."
          placeholder="Favicon URL"
          defaultValue={faviconUrl}
        />
      </div>
      <div className="actions">
        <button className="site-tile-btn primary" onClick={(e) => saveNewSite(e)} type="submit">Save</button>
        <button className="site-tile-btn secondary" onClick={() => closeModalCallback() }>Cancel</button>
        {id !== undefined &&
          <button className="site-tile-btn tertiary" onClick={() => setDeleteSiteModalOpen(o => !o)}>Delete
            Site</button>
        }
      </div>
      <Popup
        closeOnEscape
        lockScroll
        closeOnDocumentClick={false}
        className="site-dash-modal delete-confirm"
        open={deleteSiteOpen}
        onClose={closeDeleteSiteModal}
      >
        <SiteDeleteConfirm id={id} closeModalCallback={closeModalCallback} closeDeleteSiteModal={closeDeleteSiteModal} />
      </Popup>
    </div>
  )
};

export default SiteAddForm;
