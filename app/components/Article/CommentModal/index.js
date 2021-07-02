import React, { useState } from "react";
import { StyleSheet, TouchableWithoutFeedback, View } from "react-native";
import { Button, Card, Modal, Text, Icon } from "@ui-kitten/components";
import { globalStyles } from "../../../shared/globalStyles";
import { globalConstants } from "../../../constants";
import { RichEditor } from "../RichEditor";

export const CommentModal = () => {
  const [visible, setVisible] = useState(false);
  return (
    <>
      <TouchableWithoutFeedback
        onPress={() => setVisible(true)}
        style={[globalStyles.flexRow, globalStyles.alignCenter]}
      >
        <View style={globalStyles.flexRow}>
          <Icon
            fill={globalConstants.PRIMARY_COLOR}
            style={styles.icon}
            name="message-circle-outline"
          />
          <Text style={globalStyles.textSmall}>Reply</Text>
        </View>
      </TouchableWithoutFeedback>
      <Modal visible={visible} backdropStyle={styles.backdrop}>
        <Card disabled={true} style={styles.commentForm}>
          <RichEditor onChange={(e) => console.log(e)} />
          <View style={[globalStyles.flexRow, globalStyles.justifyCenter]}>
            <Button
              onPress={() => setVisible(false)}
              status="warning"
              appearance="outline"
              size="tiny"
              style={{ marginRight: 15 }}
            >
              Cancel
            </Button>

            <Button onPress={() => {}}>Submit</Button>
          </View>
        </Card>
      </Modal>
    </>
  );
};

const styles = StyleSheet.create({
  backdrop: {
    backgroundColor: "rgba(0, 0, 0, 0.5)"
  },
  icon: {
    height: 15,
    width: 15
  },
  commentForm: {
    width: (90 / 100) * globalConstants.SCREEN_WIDTH
  }
});
