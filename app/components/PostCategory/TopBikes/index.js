import React from "react";
import { Text, Layout, Icon } from "@ui-kitten/components";
import {
  Image,
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback
} from "react-native";
import { globalStyles } from "../../../shared/globalStyles";
import {
  bikeThree,
  bikeTwo,
  bikeOne
} from "../../../shared/generalAssets";
import { globalConstants } from "../../../constants";
import { numberWithCommas } from "../../../helpers/functions";

const bikes = [
  {
    name: "Yellow Red Bike",
    price: 2000,
    location: 'East Campus',
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: bikeOne
  },
  {
    name: "Yellow Red Bike",
    price: 2000,
    location: 'East Campus',
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: bikeTwo
  },
  {
    name: "Yellow Red Bike",
    price: 2000,
    location: 'East Campus',
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: bikeThree
  },
  {
    name: "Yellow Red Bike",
    price: 2000,
    location: 'East Campus',
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: bikeThree
  },
  {
    name: "Yellow Red Bike",
    price: 2000,
    location: 'East Campus',
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: bikeThree
  }
];

export const TopBikes = ({ navigation, categoryId }) => {
  const viewLandMarkDetails = () => {
    navigation.navigate("bike");
  };
  return (
    <View>
      <Text
      style={[
        globalStyles.fontAltBold,
        globalStyles.textBold,
        styles.heading
      ]}
    >
      Top Bikes
    </Text>
      <ScrollView
        horizontal={true}
        showsHorizontalScrollIndicator={false}
        scrollEventThrottle={200}
        decelerationRate="fast"
      >
        {bikes.map((bike, index) => (
          <TouchableWithoutFeedback onPress={viewLandMarkDetails} key={index}>
            <Layout style={[styles.itemBox, globalStyles.shadowBox]} level="2">
              <Image source={bike.image} style={styles.thumb}></Image>
              <View
                style={[
                  globalStyles.flexRow,
                  globalStyles.justifySpaceBetween,
                  styles.location,
                  globalStyles.shadowBox
                ]}
              >
                <Text style={globalStyles.textSmall}>  
                  <Icon
                    style={styles.icon}
                    fill={globalConstants.PRIMARY_COLOR}
                    name='pin-outline'
                  />
                  {bike.location}
                </Text>
              </View>
              <View style={[styles.caption, globalStyles.flexRow, globalStyles.justifySpaceBetween]}>
                <Text     
                  style={[globalStyles.textSecondary, styles.title]}
                >
                  {bike.name}
                </Text>
                <Text style={globalStyles.textSmall}>&#8358; {numberWithCommas(bike.price)}</Text>
              </View>
            </Layout>
          </TouchableWithoutFeedback>
        ))}
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  itemBox: {
    borderRadius: 5,
    width: (75 / 100) * globalConstants.SCREEN_WIDTH,
    marginRight: 20,
    marginVertical: 10
  },
  thumb: {
    marginTop:30,
    width: "100%",
    height: 150
  },
  caption: {
    padding: 10
  },
  icon: {
    height: 10,
    width: 10
  },
  location: {
    position: "absolute",
    top: 10,
    width: "50%",
    paddingHorizontal: 10,
    backgroundColor: '#fff',
    borderRadius: 10,
  },
  heading: {
    fontSize: 20
  }
});
