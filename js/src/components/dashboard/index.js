import React, { useState } from 'react';
import Popup from "reactjs-popup";
import './dashboard.css';
import './buttons.css';
import './modal.css';
import SiteTile from '../site-tile';
import SiteAddForm from "../site-add-form";

const Dashboard = () => {
  const [addSiteOpen, setAddSiteModalOpen] = useState(false);
  const closeAddSiteModal = () => setAddSiteModalOpen(false);

  // @todo: This is to be fetched from API or drupalSettings.
  const siteList = [
    {
      "id": "1",
      "name": "Mothercare",
      "url": "https://www.mothercare.com.kw/en",
      "endpoint": "https://www.mothercare.com.kw/en/api",
      "favicon": "https://www.axelerant.com/themes/custom/axe/favicon.ico",
      "token": "ABC123",
    },
    {
      "id": "2",
      "name": "HM",
      "url": "https://kw.hm.com/en",
      "endpoint": "https://kw.hm.com/en/api",
      "favicon": "https://www.axelerant.com/themes/custom/axe/favicon.ico",
      "token": "XYZ789",
    },
  ];

  const getSiteList = () => {
    let sites = [];
    siteList.forEach((site) => {
      sites.push(
        <SiteTile
          id={site.id}
          name={site.name}
          url={site.url}
          endpoint={site.endpoint}
          token={site.token}
          faviconUrl={site.favicon}
        />
      );
    });
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
