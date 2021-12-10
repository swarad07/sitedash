import React from 'react';

const TabContent = ({ activeTab, activeTabMethod }) => {
  // @todo: We call the respective API here to get the details.
  const response = `Content from ${activeTabMethod} API, active tab ${activeTab}`;

  return (
    <div>
      {response}
    </div>
  );
};

export default TabContent;
