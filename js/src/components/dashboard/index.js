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
        <SiteTile
          id={1}
          name="Site Name 1"
          url="https://www.example.com"
          faviconUrl="https://www.axelerant.com/themes/custom/axe/favicon.ico"
        />
        <SiteTile
          id={2}
          name="Site Name 2"
          url="https://www.example.com"
          faviconUrl="https://www.axelerant.com/themes/custom/axe/favicon.ico"
        />
        <SiteTile
          id={3}
          name="Site Name 3"
          url="https://www.example.com"
          faviconUrl="https://www.axelerant.com/themes/custom/axe/favicon.ico"
        />
      </div>
    </>
  );
}

export default Dashboard;
