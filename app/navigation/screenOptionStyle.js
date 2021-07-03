import React from "react";
const config = {
  animation: "spring",
  config: {
    stiffness: 1000,
    damping: 500,
    mass: 3,
    overshootClamping: true,
    restDisplacementThreshold: 0.01,
    restSpeedThreshold: 0.01
  }
};
const screenForFade = ({ current, closing }) => ({
  cardStyle: {
    opacity: current.progress
  }
});
const headerForFade = ({ current, next }) => {
  const opacity = Animated.add(
    current.progress,
    next ? next.progress : 0
  ).interpolate({
    inputRange: [0, 1, 2],
    outputRange: [0, 1, 0]
  });

  return {
    leftButtonStyle: { opacity },
    rightButtonStyle: { opacity },
    titleStyle: { opacity },
    backgroundStyle: { opacity }
  };
};
const MyTransition = {
  gestureDirection: "horizontal",
  transitionSpec: {
    open: config,
    close: config
  },
  cardStyleInterpolator: screenForFade,
  headerStyleInterpolator: headerForFade
};
export const screenOptionStyle = {
  headerStyle: {
    backgroundColor: "#fff"
  },
  headerTintColor: "#003399",
  headerBackTitle: "Back",
  headerTitleStyle: {
    fontWeight: "normal",
    fontSize: 16,
    color: "#000000"
  }
  // gestureEnabled: true
  // ...MyTransition
};
