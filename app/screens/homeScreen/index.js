import React from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import {
  BottomNavigation,
  BottomNavigationTab,
  Icon,
  Text
} from "@ui-kitten/components";
import { HomeStackNavigator } from "../../navigation/HomeStackNavigation";
import { globalConstants } from "../../constants";
import { globalStyles } from "../../shared/globalStyles";
import AboutScreen from "../aboutScreen";
import ProfileScreen from "../profile";

const { Navigator, Screen } = createBottomTabNavigator();

const HomeIcon = (props) => (
  <Icon {...props} fill={globalConstants.PRIMARY_COLOR} name="home-outline" />
);
const ProfileIcon = (props) => (
  <Icon
    {...props}
    fill={globalConstants.PRIMARY_COLOR}
    name="radio-button-on-outline"
  />
);
const AboutIcon = (props) => (
  <Icon
    {...props}
    fill={globalConstants.PRIMARY_COLOR}
    name="smiling-face-outline"
  />
);
const tabTitle = (title) => {
  return (
    <Text style={[globalStyles.textPrimary, globalStyles.textSmall]}>
      {title}
    </Text>
  );
};
const BottomTabBar = ({ navigation, state }) => (
  <BottomNavigation
    indicatorStyle={{
      backgroundColor: globalConstants.SECONDARY_COLOR,
      color: globalConstants.PRIMARY_COLOR,
      height: 4
    }}
    selectedIndex={state.index}
    onSelect={(index) => navigation.navigate(state.routeNames[index])}
  >
    <BottomNavigationTab title={() => tabTitle("Home")} icon={HomeIcon} />
    <BottomNavigationTab title={() => tabTitle("Profile")} icon={ProfileIcon} />
    <BottomNavigationTab title={() => tabTitle("About")} icon={AboutIcon} />
  </BottomNavigation>
);

const Home = () => (
  <Navigator tabBar={(props) => <BottomTabBar {...props} />}>
    <Screen name="Home" component={HomeStackNavigator} />
    <Screen name="Profile" component={ProfileScreen} />
    <Screen name="About" component={AboutScreen} />
  </Navigator>
);

export default Home;
