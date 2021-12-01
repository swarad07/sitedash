import React from 'react';

const SiteTile = ({id, name, faviconUrl, url}) => {
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
        <div>
          <button className="site-tile-btn--secondary">Edit</button>
        </div>
      </div>
      <div className="site-tile--action">
        <button className="site-tile-btn secondary">Status</button>
        <button className="site-tile-btn secondary">Logs</button>
        <button className="site-tile-btn secondary">Overview</button>
      </div>
    </div>
  );
};

export default SiteTile;
