import React from 'react';
import './dashboard.css';
import './buttons.css';
import SiteTile from '../site-tile';

const Dashboard = () => {
  return (
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
  );
}

export default Dashboard;
