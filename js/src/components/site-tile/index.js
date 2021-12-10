import React, {useState} from 'react';
import Popup from "reactjs-popup";
import SiteAddForm from "../site-add-form";
import Overview from "../overview";

const SiteTile = ({id, name, faviconUrl, url, endpoint, token}) => {
  const [addSiteOpen, setAddSiteModalOpen] = useState(false);
  const [overviewOpen, setOverviewOpen] = useState(false);
  const closeAddSiteModal = () => setAddSiteModalOpen(false);
  const closeOverviewModal = () => setOverviewOpen(false);

  return (
    <div
      className="site-tile"
      id={`site-tile-${id}`}
    >
      <div className="site-tile--details">
        <div>
          <img loading="lazy" height="40" width="40" src={faviconUrl} />
          <h2>{name}</h2>
          <a href={url}>{url}</a>
        </div>
      </div>
      <div className="site-tile--action">
        <button className="site-tile-btn secondary" onClick={() => setAddSiteModalOpen(o => !o)}>Edit</button>
        <button className="site-tile-btn secondary" onClick={() => setOverviewOpen(o => !o)}>Overview</button>
      </div>
      <Popup
        closeOnEscape
        lockScroll
        closeOnDocumentClick={false}
        className="site-dash-modal"
        open={addSiteOpen}
        onClose={closeAddSiteModal}
      >
        <SiteAddForm
          id={id}
          name={name}
          favicon={faviconUrl}
          url={url}
          endpoint={endpoint}
          token={token}
          closeModalCallback={closeAddSiteModal}
        />
      </Popup>
      <Popup
        closeOnEscape
        lockScroll
        closeOnDocumentClick={false}
        className="site-dash-modal overview-modal"
        open={overviewOpen}
        onClose={closeOverviewModal}
      >
        <Overview closeOverviewModal={closeOverviewModal}/>
      </Popup>
    </div>
  );
};

export default SiteTile;
