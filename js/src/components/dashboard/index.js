import React, { useState, useEffect } from 'react';
import Popup from 'reactjs-popup';
import axios from 'axios';
import './dashboard.css';
import './buttons.css';
import './modal.css';
import SiteTile from '../site-tile';
import SiteAddForm from '../site-add-form';

const Dashboard = () => {
  const [addSiteOpen, setAddSiteModalOpen] = useState(false);
  const closeAddSiteModal = () => setAddSiteModalOpen(false);

  // State for site API response.
  const [siteList, setSiteList] = useState(null);

  useEffect(() => {
    axios.get('/jsonapi/sitedash_entity/sitedash_entity')
      .then(function (response) {
        // handle success
        const { data } = response;
        setSiteList(data);
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      });
  }, []);

  const getSiteList = () => {
    let sites = [];
    if (siteList && siteList.meta.count > 0) {
      siteList.data.forEach((site) => {
        const { attributes } = site;
        sites.push(
          <SiteTile
            id={site.id}
            name={attributes.name}
            url={attributes.siteUrl}
            endpoint={attributes.siteAPIUrl}
            token={attributes.siteToken}
            faviconUrl={attributes.siteFavicon}
          />
        );
      });
    }

    return sites;
  };

  return (
    <>
      <div className="site-dashboard-header">
        <button
          type="button"
          className="site-tile-btn primary"
          onClick={() => setAddSiteModalOpen(o => !o)}
        >
          Add Site
        </button>
        <Popup
          closeOnEscape
          lockScroll
          closeOnDocumentClick={false}
          className="site-dash-modal"
          open={addSiteOpen}
          onClose={closeAddSiteModal}
        >
          <SiteAddForm closeModalCallback={closeAddSiteModal} />
        </Popup>
      </div>
      <div className="site-list">
        { getSiteList() }
      </div>
    </>
  );
}

export default Dashboard;
