import React, { useState } from 'react';
import TabContent from './tab-content';
import './overview-modal.css';
import './tabs.css';

const Overview = ({ closeOverviewModal }) => {
  const [activeTab, setActiveTab] = useState("1");
  const [activeTabMethod, setActiveTabMethod] = useState("http-check");

  const tabClick = (e) => {
    setActiveTab(e.target.dataset.tabIndex);
    setActiveTabMethod(e.target.dataset.callbackMethod);
    // Set classes.
    document.querySelector('.tab-item.active').classList.remove('active');
    e.target.classList.add('active');
  };

  return (
    <div className="overview-wrapper">
      <div className="header">
        <h2>Site Overview</h2>
        <button className="site-tile-btn tertiary" onClick={() => closeOverviewModal()}>Close</button>
      </div>
      <div className="tabs">
        <ul>
          <li
            onClick={(e) => tabClick(e)}
            data-tab-index="1"
            data-callback-method="http-check"
            className="tab-item active"
          >
            Availability
          </li>
          <li
            onClick={(e) => tabClick(e)}
            data-tab-index="2"
            data-callback-method="status-check"
            className="tab-item"
          >
            Status Report
          </li>
          <li
            onClick={(e) => tabClick(e)}
            data-tab-index="3"
            data-callback-method="logs-check"
            className="tab-item"
          >
            Recent Logs
          </li>
          <li
            onClick={(e) => tabClick(e)}
            data-tab-index="4"
            data-callback-method="stats-check"
            className="tab-item"
          >
            Content Statistics
          </li>
          <li
            onClick={(e) => tabClick(e)}
            data-tab-index="5"
            data-callback-method="update-check"
            className="tab-item"
          >
            Update Information
          </li>
        </ul>
      </div>
      <div className="tab-content">
        <TabContent
          activeTab={activeTab}
          activeTabMethod={activeTabMethod}
        />
      </div>
    </div>
  );
};

export default Overview;
